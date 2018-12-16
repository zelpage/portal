<?php

	declare(strict_types=1);

	require __DIR__ . '/../vendor/autoload.php';

	use \Nette\Database\DriverException;
	use \Nette\Database\ResultSet;
	use \Tracy\Debugger;
	use \Nette\Configurator;
	use \Nette\Database\Connection;
	use \Tracy\ILogger;

	$isDevMachine = in_array(getenv('COMPUTERNAME'), [
		'FORTEZZA',
		'HUMBLEHORNET',
		'HUNDERTHAF',
		'MATOUSDANIELKA',
	]);

	$configurator = new Configurator;

	$environment = Configurator::detectDebugMode($isDevMachine)
		? 'development' : 'production';
	$configFile = "/config/config.{$environment}.neon";

	$configurator->enableTracy(__DIR__ . '/../log');

	$configurator->setTimeZone('Europe/Prague');
	$configurator->setTempDirectory(__DIR__ . '/../temp');

	$configurator->createRobotLoader()
		->addDirectory(__DIR__)
		->register();

	$configurator->addConfig(__DIR__ . '/config/config.neon');
	$configurator->addConfig(__DIR__ . $configFile);

	$container = $configurator->createContainer();

	if ($isDevMachine) {
		$connection = $container->getByType('Nette\Database\Connection');
		$connection->onQuery[] = function(Connection $conn, $result) {
			if ($result instanceof ResultSet) {
				Debugger::log("SQL QUERY {$result->getQueryString()}");
			}
			else if ($result instanceof DriverException) {
				Debugger::log("SQL ERROR {$result->getDriverCode()} {$result->getSqlState()} {$result->getMessage()} QUERY {$result->getQueryString()}", ILogger::ERROR);
			}
		};
	}

	return $container;
