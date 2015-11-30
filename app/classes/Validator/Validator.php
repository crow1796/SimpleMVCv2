<?php

namespace App\Classes\Validator;
use App\Classes\Validator\RulesTrait as Rules;

class Validator{
	use Rules;
	protected $errors = [];
	protected $connection;

	public function __construct($connection){
		$this->connection = $connection;
	}

	public function validate($data, $rules){
		array_walk($rules, [$this, 'extractFields'], $data);
		return $this;
	}

	protected function extractFields($fieldRules, $fieldName, $data){
		$requiredData = [];
		$requiredData['fieldName'] = $fieldName;
		$requiredData['field'] = $data[$fieldName];
		array_walk($fieldRules, [$this, 'extractRules'], $requiredData);
	}

	protected function extractRules($ruleValue, $ruleName, $requiredData){
		call_user_func_array([$this, $ruleName], [$requiredData['fieldName'], $requiredData['field'], $ruleValue]);
	}

	protected function addError($error = ''){
		$this->errors[] = $error;
	}

	public function errors(){
		return $this->errors;
	}

	public function passes(){
		if(count($this->errors()) > 0){
			return false;
		}

		return true;
	}

	public function fails(){
		return !$this->passes()? true: false;
	}
}