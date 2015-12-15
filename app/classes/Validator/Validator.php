<?php

namespace App\Classes\Validator;
use App\Classes\Validator\RulesTrait as Rules;
use App\Classes\Utils\Token;
use App\Classes\Utils\Globals;
use App\Classes\Core\Container;

class Validator{
	use Rules;
	protected $errors = [];
	protected $connection;

	/**
	 * Constructor:
	 * Resolve dependecies.
	 */
	public function __construct(){
		$this->connection = Container::resolve('db.connection');
	}

	/**
	 * Validate data.
	 * @param  array $data  
	 * @param  array $rules 
	 * @return mixed        
	 */
	public function validate($data, $rules){
		if(Token::match($data[Globals::TOKEN_NAME])){
			array_walk($rules, [$this, 'extractFields'], $data);
			return $this;
		}
		return false;
	}

	/**
	 * Extract fieldsNames and fieldValues from rules array and data array.
	 * @param  array $fieldRules 
	 * @param  mixed $fieldName  
	 * @param  array $data       
	 * @return mixed             
	 */
	protected function extractFields($fieldRules, $fieldName, $data){
		$requiredData = [];
		$requiredData['fieldName'] = $fieldName;
		$requiredData['field'] = $data[$fieldName];
		array_walk($fieldRules, [$this, 'extractRules'], $requiredData);
	}

	/**
	 * Extract rules.
	 * @param  array $ruleValue    
	 * @param  String $ruleName     
	 * @param  array $requiredData 
	 * @return mixed               
	 */
	protected function extractRules($ruleValue, $ruleName, $requiredData){
		call_user_func_array([$this, $ruleName], [$requiredData['fieldName'], $requiredData['field'], $ruleValue]);
	}

	/**
	 * Add error if some validation fails.
	 * @param String $error 
	 */
	protected function addError($error = ''){
		$this->errors[] = $error;
	}

	/**
	 * Retrieve all errors.
	 * @return array 
	 */
	public function errors(){
		return $this->errors;
	}

	/**
	 * Returns true if errors count is <= 0.
	 * @return Boolean 
	 */
	public function passes(){
		return (count($this->errors) > 0) ? false : true;
	}

	/**
	 * Returns true if errors count is > 0.
	 * @return Boolean 
	 */
	public function fails(){
		return $this->passes() === false? true: false;
	}
}
