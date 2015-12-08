<?php

use App\Classes\Router\Facades\RouteFacade as Route;

// $controllers = [
// 	'AuthController' => ['getLogin', 'postLogin', 'getRegister', 'postRegister', 'getLogout'],
// 	'PagesController' => ['home']
// ];

$routes = [
	'login'										=> 'AuthController@getLogin',
	'login/attempt'						=> 'AuthController@postLogin',

	'register'								=> 'AuthController@getRegister',
	'register/submit'					=> 'AuthController@postRegister',

	'user/logout'							=> 'AuthController@getLogout',

	'forgot-password'					=> 'AuthController@getForgotPassword',
	'forgot-password/recover'	=> 'AuthController@postForgotPassword',

	'home'										=> 'PagesController@index',

	'sampleajax'						=> 'AuthController@sampleAjax'
];

// Route::register($controller, $action, $controllers);
Route::register($url, $routes);
