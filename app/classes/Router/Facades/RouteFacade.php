<?php

namespace App\Classes\Router\Facades;
use \Exception;
use App\Controllers;
use App\Classes\Databases\Factories\DatabaseFactory as DBFactory;
use App\Classes\Utils\Globals;
use App\Views\View;

class RouteFacade{

	private static $database;
	private static $view;
	private static $routes = array();

	/**
	 * Constructor.
	 */
	public function __construct(){

	}

	/**
	 * Method static caller.
	 * @param  String $method
	 * @param  array $params
	 * @return mixed
	 */
	public static function __callStatic($method, $params){
		return call_user_func_array([self, $method], $params);
	}

	/**
	 * Register post routes.
	 * @param  String $url
	 * @param  String $action
	 * @return mixed
	 */
	public function post($url, $action){
		self::$routes['post'][$url] = $action;
	}

	/**
	 * Register get routes.
	 * @param  String $url
	 * @param  String $action
	 * @return mixed
	 */
	public function get($url, $action){
		self::$routes['get'][$url] = $action;
	}

	/**
	 * Check browser url with the current request_method.
	 * @param  String $url
	 * @param  String $requestMethod
	 * @return mixed
	 */
	public function check($url, $requestMethod){
		if(!array_key_exists($url, self::$routes[strtolower($requestMethod)])){
			throw new Exception('Route Not Found: ' . $url);
		}
		return self::call(self::$routes[strtolower($requestMethod)][$url]);
	}

	/**
	 * Call the controller and method if exists.
	 * @param  String $route
	 * @param  array  $params
	 * @return mixed
	 */
	private function call($route, $params = array()){
		// RouteAction - ExampleController@method; explode and assign into $routeAction
		$routeAction = explode('@', $route);
		// Name of controller
	 	$controllerName = $routeAction[0];
		// Name of method
		$methodName = $routeAction[1];
		// Create controller with default namespace.
		$controller = 'App\Controllers\\' .	$controllerName;
		// Create controller instance
		$controller = new $controller();

		return call_user_func_array([$controller, $methodName], $params);
	}
}
