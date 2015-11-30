<?php

namespace App\Classes\Utils;

class Input{
	public static function get($name){
		return isset($_POST[$name]) ? $_POST[$name] : $_GET[$name];
	}

	public static function set($name, $value){
		return $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST[$name] = $value : $_GET[$name] = $value;
	}

	public static function has($name){
		return isset($_POST[$name])? isset($_POST[$name]) : isset($_GET[$name]);
	}

	public function all(){
		return $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST : $_GET;
	}
}