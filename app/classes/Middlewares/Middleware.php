<?php

namespace App\Classes\Middlewares;

abstract class Middleware{
	public function __construct(){
		$this->handle();
	}

	public abstract function handle();
}