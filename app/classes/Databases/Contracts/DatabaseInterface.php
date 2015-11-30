<?php

namespace App\Classes\Databases\Contracts;

interface DatabaseInterface{
	public function connect();
	public function makeConnection();
}