<?php

use App\Classes\Router\Facades\RouteFacade as Route;

// $controllers = [
// 	'AuthController' => ['getLogin', 'postLogin', 'getRegister', 'postRegister', 'getLogout'],
// 	'PagesController' => ['home']
// ];

$routes = [
	'login'								=> 'AuthController@getLogin',
	'login/attempt'				=> 'AuthController@postLogin',
	'register'						=> 'AuthController@getRegister',
	'register/submit'			=> 'AuthController@postRegister',
	'user/logout'					=> 'AuthController@getLogout',
	'home'								=> 'PagesController@index'
];

// Route::register($controller, $action, $controllers);
Route::register($url, $routes);
