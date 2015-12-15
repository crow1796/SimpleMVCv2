<?php

session_start();
require_once 'vendor/autoload.php';
require_once 'app/classes/utils/helpers.php';
use App\Classes\Utils\Globals;
use App\Classes\Utils\Input;
use App\Classes\Core\Container;
use App\Classes\Databases\Factories\DatabaseFactory as DBFactory;
use App\Views\View;

// Set default url if not found in url.
$url = Globals::DEFAULT_URL;

// Get url from url.
if(Input::has('url')){
	$url = stripslashes(Input::get('url'));
}

// Register Dependecies
Container::register('db', function(){
	return DBFactory::make('App\Classes\Databases\\' . Globals::DB_CLASS);
});
Container::register('db.connection', function(){
	return Container::resolve('db')->getConnection();
});
Container::register('view', function(){
	return (new View());
});

require_once 'app/routes.php';
