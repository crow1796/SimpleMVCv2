<?php

namespace App\Classes\Middlewares\Auth;
use App\Classes\Middlewares\Middleware;
use App\Classes\Utils\Session;
use App\Classes\Utils\Globals;
use App\Classes\Utils\Redirect;

class RedirectIfAuthenticated extends Middleware{
	public function handle(){
		if(Session::has(Globals::LOGGED_USER)){
			Redirect::to('?controller=PagesController&action=home');
		}
		return false;
	}
}