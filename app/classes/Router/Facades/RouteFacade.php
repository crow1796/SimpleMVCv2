<?php

namespace App\Classes\Router\Facades;
use \Exception;
use App\Controllers;
use App\Classes\Databases\Factories\DatabaseFactory as DBFactory;
use App\Classes\Utils\Globals;

class RouteFacade{

	private static $database;

	public function __construct(){

	}

	public static function __callStatic($method, $params){
		return call_user_func_array(register(), $params);
	}

	public function register($url, $routes){
		if(!array_key_exists($url, $routes)){
			throw new Exception('Route Not Found: ' . $url);
		}

		self::call($routes[$url]);
	}

	// public function register($controller, $action, $controllers){
	// 	if(!array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller])){
	// 		throw new Exception('Controller or action not found!');
	// 	}
	//
	// 	self::call($controller, $action);
	// }

	private function call($route){
		// Create Database Instance
		self::$database = DBFactory::make('App\Classes\Databases\\' . Globals::DB_CLASS);
		// Request Method
		// RouteAction - ExampleController@method
		$routeAction = explode('@', $route);
		// Name of controller
	 	$controllerName = $routeAction[0];
		// Name of method
		$methodName = $routeAction[1];
		// Controller with namespace
		$controller = 'App\Controllers\\' .	$controllerName;
		// Create controller instance
		$controller = new $controller(self::$database);

		return call_user_func_array([$controller, $methodName], array());
	}

	// private function call($controller, $action){
	// 	self::$database = DBFactory::make('App\Classes\Databases\\' . Globals::DB_CLASS);
	// 	$controller = 'App\Controllers\\' . $controller;
	// 	$controller = new $controller(self::$database);
	//
	// 	return call_user_func_array([$controller, $action], array());
	// }
}
