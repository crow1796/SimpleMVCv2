<?php

namespace App\Classes\Databases;
use App\Classes\Databases\Adapters\DatabaseAdapter;
use App\Classes\Utils\Globals;
use \PDO;

class MysqlDatabase extends DatabaseAdapter{
	public function makeConnection(){
		return new PDO('mysql:host=' . Globals::DB_HOST . ';dbname=' . Globals::DB_NAME . ';', Globals::DB_USERNAME, Globals::DB_PASSWORD);
	}
}