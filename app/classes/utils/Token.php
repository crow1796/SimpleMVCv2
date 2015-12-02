<?php

namespace App\Classes\Utils;
use App\Classes\Utils\Session;
use App\Classes\Utils\Globals;

class Token{
	public static function generate(){
		return Session::set(Globals::TOKEN_NAME, md5(uniqid()));
	}

	public static function match($token){
		if($token != Session::get(Globals::TOKEN_NAME)){
			return false;
		}
		return true;
	}
}