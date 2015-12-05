<?php

namespace App\Classes\Utils;
use App\Classes\Utils\Session;
use App\Classes\Utils\Globals;

class Token{
	public static function generate(){
		return Session::set(Globals::TOKEN_NAME, md5(uniqid()));
	}

	public static function match($token){
		if(isset($token) && !empty($token) && $token === Session::get(Globals::TOKEN_NAME)){
			return true;
		}
		return false;
	}
}
