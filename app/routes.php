<?php
// TODO: URL with wildcards.
// TODO: Request class.
// TODO: Middleware
use App\Classes\Router\Facades\RouteFacade as Route;

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::post('logout', 'Auth\AuthController@getLogout');

Route::get('recover', 'Auth\AuthController@getForgotPassword');
Route::post('recover', 'Auth\AuthController@postForgotPassword');

Route::get('home', 'PagesController@index');

Route::post('sampleajax', 'Auth\AuthController@sampleAjax');

Route::get('profile/friends/{name}', 'Auth\AuthController@testWildcards');
