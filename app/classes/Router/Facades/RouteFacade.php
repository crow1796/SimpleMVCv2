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

	protected static $matchedUrl;
	protected static $params = array();

	/**
	 * Constructor.
	 */
	public function __construct(){

	}

	/**
	 * Static method caller.
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
		$requestMethod = strtolower($requestMethod);
		if(!array_key_exists($url, self::$routes[$requestMethod])){

			// Count how many uris are not equal and must be on the same index
			// Count how many uris are equal and must be on the same index
			$hasMatched = array_walk(self::$routes[$requestMethod], function($value, $key) use ($url){
				$registeredUrl = explode('/', $key);
				$browserUrl = explode('/', rtrim($url, '/'));

				if(count($registeredUrl) != count($browserUrl)){
					return true;
				}

				for($counter = 0; $counter < count($registeredUrl); $counter++){
					if((!strstr($registeredUrl[$counter], '{')) && $registeredUrl[$counter] != $browserUrl[$counter]){
						return false;
					}

					if($registeredUrl[$counter] != $browserUrl[$counter] && strstr($registeredUrl[$counter], '{')){
						preg_match('/{(.+)}/', $registeredUrl[$counter], $wildCard);
						$wildCard[1] = strtolower($wildCard[1]);
						self::$params[$wildCard[1]] = $browserUrl[$counter];
					}
				}

				self::$matchedUrl = $key;
			});

			if($hasMatched){
				return self::call(self::$routes[$requestMethod][self::$matchedUrl], self::$params);
			}
			throw new Exception('Route Not Found: ' . $url);
		}
		return self::call(self::$routes[$requestMethod][$url]);
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

		return call_user_func_array([$controller, $methodName], [$params]);
	}
}
