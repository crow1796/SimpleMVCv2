<?php

namespace App\Models;
use App\Classes\Databases\Queries\Query;

class Model{
	use Query;
	protected $table;
	protected $connection;

	public function __construct($connection){
		$this->connection = $connection;
	}
}
