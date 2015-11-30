<?php
namespace App\Classes\Validator;

trait RulesTrait{
	protected function required($key, $data, $required){
		if($required){
			if(empty($data)){
				$this->addError(ucfirst($key) . ' field is required.');
				return false;
			}
		}
		return true;
	}

	protected function min($key, $data, $length){
		if(strlen($data) < $length){
			$this->addError(ucfirst($key) . ' field has to be at least ' . $length . ' characters.');
			return false;
		}
		return true;
	}

	protected function max($key, $data, $length){
		if(strlen($data) > $length){
			$this->addError(ucfirst($key) . ' field has to be maximum of ' . $length . ' characters.');
			return false;
		}
		return true;
	}

	protected function email($key, $data, $mustBeAnEmail){
		if($mustBeAnEmail){
			if(!preg_match_all('/[a-zA-Z0-9\.-]+[@{1}][a-zA-Z0-9]+[\.{1}][a-zA-Z]+/i', $data)){
				$this->addError(ucfirst($key) . ' must be a valid e-mail address.');			
				return false;
			}
		}
		return true;
	}

	protected function confirmed($key, $data, $comparedValue){
		if($data != $comparedValue){
			preg_match('/-(\w+)/', $key, $tmp);
			$this->addError(ucfirst($key) . ' must be equal to ' . ucfirst(ltrim($tmp[0], '-')) . '.');
			return false;
		}
		return true;
	}

	protected function unique($key, $data, $model){
		$record = (new $model($this->connection))->findBy($key, $data);
		if($record){
			$this->addError(ucfirst($key) . ' already exists.');
			return false;
		}
		return true;
	}
}