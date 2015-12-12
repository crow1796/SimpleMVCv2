<?php

session_start();
require_once 'vendor/autoload.php';
require_once 'app/classes/utils/helpers.php';
use App\Classes\Utils\Globals;
use App\Classes\Utils\Input;
use App\Classes\Core\Container;
use App\Classes\Databases\Factories\DatabaseFactory as DBFactory;

// $controller = Globals::DEFAULT_CONTROLLER;
// $action = Globals::DEFAULT_ACTION;

$url = Globals::DEFAULT_URL;

if(Input::has('url')){
	$url = stripslashes(Input::get('url'));
}

// if(Input::has('controller') && Input::has('action')){
// 	$controller = Input::get('controller');
// 	$action = Input::get('action');
// }

// Register Dependecies
Container::register('db', function(){
	return DBFactory::make('App\Classes\Databases\\' . Globals::DB_CLASS);
});

Container::register('db.connection', function(){
	return Container::resolve('db')->getConnection();
});

require_once 'app/routes.php';
