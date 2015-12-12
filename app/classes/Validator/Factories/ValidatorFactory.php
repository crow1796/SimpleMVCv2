<?php

namespace App\Classes\Validator\Factories;
use App\Classes\Validator\Validator;

class ValidatorFactory {

	protected $validator;

	public static function make($data, $rules = array()){
		$validator = null;
		if(!empty($data) && !empty($rules)){
			$validator = new Validator();
			$validator->validate($data, $rules);
			return $validator;
		}
		return false;
	}
}
