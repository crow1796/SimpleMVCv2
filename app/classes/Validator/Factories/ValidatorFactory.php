<?php

namespace App\Classes\Validator\Factories;
use App\Classes\Validator\Validator;

class ValidatorFactory {

	protected $validator;

	/**
	 * Create new validator object and validate the data with the rules passed.
	 * @param  array $data  
	 * @param  array  $rules 
	 * @return mixed        
	 */
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
