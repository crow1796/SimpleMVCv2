<?php

use App\Classes\Utils\Input;
use App\Classes\Core\Container;
use App\Classes\Databases\Factories\DatabaseFactory as DBFactory;
use App\Classes\Utils\Globals;
use App\Views\View;
use App\Classes\Router\Facades\RouteFacade;

// Register Dependecies
Container::register('db', function(){
	return (new DBFactory)->make('App\Classes\Databases\\' . Globals::DB_CLASS);
});
Container::register('db.connection', function(){
	return Container::resolve('db')->getConnection();
});
Container::register('view', function(){
	return (new View());
});
Container::register('route', function(){
	return (new RouteFacade());
});
