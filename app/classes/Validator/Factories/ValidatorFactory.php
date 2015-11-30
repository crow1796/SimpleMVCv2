<?php

namespace App\Classes\Validator\Factories;
use App\Classes\Validator\Validator;

class ValidatorFactory {

	protected $validator;

	public static function make($data, $rules = array(), $connection){
		$validator = null;
		if(!empty($data) && !empty($rules) && !is_null($connection)){
			$validator = new Validator($connection);
			$validator->validate($data, $rules);
		}
		return $validator;
	}
}