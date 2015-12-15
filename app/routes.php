<?php
use App\Classes\Router\Facades\RouteFacade as Route;

// $routes = [
// 	'login'										=> 'Auth\AuthController@getLogin',
// 	'login/attempt'						=> 'Auth\AuthController@postLogin',
//
// 	'register'								=> 'Auth\AuthController@getRegister',
// 	'register/submit'					=> 'Auth\AuthController@postRegister',
//
// 	'user/logout'							=> 'Auth\AuthController@getLogout',
//
// 	'forgot-password'					=> 'Auth\AuthController@getForgotPassword',
// 	'forgot-password/recover'	=> 'Auth\AuthController@postForgotPassword',
//
// 	'home'										=> 'PagesController@index',
//
// 	'sampleajax'							=> 'Auth\AuthController@sampleAjax',
// ];
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::post('logout', 'Auth\AuthController@getLogout');

Route::get('recover', 'Auth\AuthController@getForgotPassword');
Route::post('recover', 'Auth\AuthController@postForgotPassword');

Route::get('home', 'PagesController@index');

Route::post('sampleajax', 'Auth\AuthController@sampleAjax');

Route::check($url, $_SERVER['REQUEST_METHOD']);
