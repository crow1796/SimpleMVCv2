<?php

namespace App\Controllers;
use App\Classes\Databases\Contracts\DatabaseInterface;

class Controller {
	protected $database;

	public function __construct(DatabaseInterface $database){
		$this->database = $database;
	}

	public function middleware($middlewares){
		if(is_array($middlewares)){
			array_walk($middlewares, [$this, 'handleMiddleware']);
			return true;
		}
		$middleware = new $middlewares;
		return $middleware->handle();
	}

	public function handleMiddleware($value){
		$middleware = new $value();
		return $middleware->handle();
	}
}