<?php

namespace App\Classes\Middlewares\Auth;
use App\Classes\Middlewares\Middleware;
use App\Classes\Utils;

class RedirectIfNotAuthenticated extends Middleware{
	public function handle(){
		if(!Utils\Session::has(Utils\Globals::LOGGED_USER)){
			Utils\Redirect::to(url('login'));
		}
		return false;
	}
}
