<?php

namespace App\Classes\Databases\Factories;
use App\Classes\Database;

class DatabaseFactory{
	/**
	 * Create new database instance
	 * @param  String $database 
	 * @return mixed           
	 */
	public static function make($database){
		if(!empty($database)){
			$database = new $database();
		}
		return $database;
	}
}