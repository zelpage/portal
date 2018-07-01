<?php

	declare(strict_types=1);

	require __DIR__ . '/../vendor/autoload.php';

	use \Nette\Configurator;

	$isDevMachine = in_array(getenv('COMPUTERNAME'), array(
		'FORTEZZA',
		'HUMBLEHORNET',
		'HUNDERTHAF',
		'MATOUSDANIELKA',
	));

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

	return $container;
