<?php

namespace App\Classes\Auth;
use App\Models\User;
use App\Classes\Databases\Contracts\DatabaseInterface;
use App\Classes\Utils\Session;
use App\Classes\Utils\Redirect;
use App\Classes\Utils\Globals;

class Authenticator{
	protected $connection;
	public function __construct($connection){
		$this->connection = $connection;
	}

	public function attempt($finder, $inputs){
		$user = (new User($this->connection))->findBy($finder, $inputs['username']);
		if(!is_null($user) && password_verify($inputs['password'], $user->password)){
			Session::set(Globals::LOGGED_USER, $user->id);
			Redirect::to('?controller=PagesController&action=home');
		}
		$errors[] = 'Invalid username or password. Try again.';
		Session::flash('errors', $errors);
		Redirect::to('?controller=AuthController&action=getLogin');
	}
}