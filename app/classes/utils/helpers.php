<?php

function base_path($path = ''){
	$path = ltrim($path, '/');
	return dirname(dirname(dirname(dirname(__FILE__)))). '/' . $path;
}

function app_path($path = ''){
	$path = ltrim($path, '/');
	return base_path() . 'app/' . $path;
}

function public_path($path = ''){
	$path = ltrim($path, '/');
	return 'app/public/' . $path;
}

function view($path = '', $params = array()){
	$path = ltrim($path, '/');
	if(file_exists(app_path('views/' . $path . '.php'))){
		require_once app_path('views/' . $path . '.php');
	}
}