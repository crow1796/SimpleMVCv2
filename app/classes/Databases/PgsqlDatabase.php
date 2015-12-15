<?php

namespace App\Classes\Databases;
use App\Classes\Databases\Adapters\DatabaseAdapter;

class PgsqlDatabase extends DatabaseAdapter{
	/**
	 * Create pdo instance based on postgresql.
	 * @return mixed 
	 */
	public function makeConnection(){
		return new PDO('pgsql:');
	}
}