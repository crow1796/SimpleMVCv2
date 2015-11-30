<?php

namespace App\Classes\Databases\Factories;
use App\Classes\Database;

class DatabaseFactory{
	public static function make($database){
		if(!empty($database)){
			$database = new $database();
		}
		return $database;
	}
}