<?php

namespace App\Models;
use App\Classes\Databases\Queries\Query;
use App\Classes\Core\Container;

class Model{
	use Query;
	protected $table;
	protected $connection;

	public function __construct(){
		$this->connection = Container::resolve('db.connection');
	}
}
