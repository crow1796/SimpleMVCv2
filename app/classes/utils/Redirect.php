<?php

namespace App\Classes\Utils;

class Redirect{
	public static function to($location){
		header('Location: ' . $location);
		exit();
	}
}