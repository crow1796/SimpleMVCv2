<?php

use App\Classes\Router\Facades\RouteFacade as Route;

$controllers = [
	'AuthController' => ['getLogin', 'postLogin', 'getRegister', 'postRegister'],
	'PagesController' => ['home']
];

Route::register($controller, $action, $controllers);