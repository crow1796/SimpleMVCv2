<?php

namespace App\Classes\Databases\Adapters;
use App\Classes\Databases\Contracts\DatabaseInterface as Database;

abstract class DatabaseAdapter implements Database{

	protected $pdo;

	public function __construct(){
		$this->connect();
	}

	public function connect(){
		if(is_null($this->pdo) || (!$this->pdo instanceof PDO)){
			$this->pdo = $this->makeConnection();
		}
	}

	public abstract function makeConnection();

	public function getConnection(){
		return $this->pdo;
	}
}