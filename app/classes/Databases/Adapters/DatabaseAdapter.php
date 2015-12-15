<?php

namespace App\Classes\Databases\Adapters;
use App\Classes\Databases\Contracts\DatabaseInterface as Database;

abstract class DatabaseAdapter implements Database{

	protected $pdo;

	public function __construct(){
		$this->connect();
	}

	/**
	 * Check if the connection is null,
	 * if null create new.
	 * @return mixed 
	 */
	public function connect(){
		if(is_null($this->pdo) || (!$this->pdo instanceof PDO)){
			$this->pdo = $this->makeConnection();
		}
	}

	/**
	 * Set the connection.
	 * @return mixed 
	 */
	public abstract function makeConnection();

	/**
	 * Get the connection.
	 * @return mixed 
	 */
	public function getConnection(){
		return $this->pdo;
	}
}