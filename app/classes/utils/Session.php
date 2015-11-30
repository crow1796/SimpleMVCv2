<?php

namespace App\Classes\Utils;

class Session{
	public static function has($name){
		return isset($_SESSION[$name]) ? true : false;
	}

	public function get($name){
		return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
	}

	public function set($name, $value){
		return $_SESSION[$name] = $value;
	}

	public function flash($name, $value = ''){
		if(!empty($value)){
			$_SESSION[$name] = $value;
			return true;
		}
		$session = $_SESSION[$name];
		unset($_SESSION[$name]);
		return $session;
	}
}