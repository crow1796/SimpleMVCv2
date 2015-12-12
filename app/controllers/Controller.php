<?php

namespace App\Controllers;
use App\Classes\Databases\Contracts\DatabaseInterface;
use App\Classes\Utils\Input;
use App\Views\View;

class Controller {
	protected $view;
	protected $className = __CLASS__;

	public function __construct(){
		$this->view = new View();
	}

	public function middleware($middlewares, $options = array()){
		if(!empty($options['except']) && count($options['except']) > 0){
			array_walk($options['except'], [$this, 'checkExceptions'], $middlewares);
			return true;
		}
		if(is_array($middlewares)){
			array_walk($middlewares, [$this, 'handleMiddleware']);
			return true;
		}
		$middleware = new $middlewares;
		return $middleware->handle();
	}

	public function checkExceptions($value, $key, $middlewares){
		// if(Input::get('action') != $value){
		// 	if(is_array($middlewares)){
		// 		array_walk($middlewares, [$this, 'handleMiddleware']);
		// 	}
		// 	$middleware = new $middlewares;
		// 	return $middleware->handle();
		// }
		// return false;
	}

	public function handleMiddleware($value){
		$middleware = new $value();
		return $middleware->handle();
	}
}
