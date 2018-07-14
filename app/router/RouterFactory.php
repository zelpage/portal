<?php

	namespace ZelPage;

	use \Nette\StaticClass;
	use \Nette\Application\Routers\Route;
	use \Nette\Application\Routers\RouteList;

	class RouterFactory {
		use StaticClass;

		public static function createRouter() : RouteList {
			$router = new RouteList;
			$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
			return $router;
		}

	}
