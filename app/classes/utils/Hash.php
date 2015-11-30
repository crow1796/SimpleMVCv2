<?php

namespace App\Classes\Utils;

class Hash{
	public static function make($value){
		$options = [
					'salt' => 'whutdafukhowboutdissalt?',
					'cost' => 12
		];
		return password_hash($value, \PASSWORD_DEFAULT, $options);
	}
}