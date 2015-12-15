<?php

namespace App\Classes\Auth;
use App\Models\User;
use App\Classes\Databases\Contracts\DatabaseInterface;
use App\Classes\Utils\Session;
use App\Classes\Utils\Redirect;
use App\Classes\Utils\Globals;
use App\Classes\Core\Container;

class Authenticator{
	protected $connection;
	/**
	 * Constructor:
	 * Resolve Dependecies.
	 */
	public function __construct(){
		$this->connection = Container::resolve('db.connection');
	}

	/**
	 * Attempt user login.
	 * @param  mixed $finder 
	 * @param  array $inputs 
	 * @return null         
	 */
	public function attempt($finder, $inputs){
		$user = (new User($this->connection))->findBy($finder, $inputs[$finder]);
		if(!is_null($user) && password_verify($inputs['password'], $user->password)){
			Session::set(Globals::LOGGED_USER, $user->id);
			Redirect::to(url('home'));
		}
		$errors[] = 'Invalid username or password. Try again.';
		Session::flash('errors', $errors);
		Redirect::to(url('login'));
	}

	/**
	 * Logout signed in user.
	 * @return null 
	 */
	public function logoutUser(){
		Session::delete(Globals::LOGGED_USER);
		Redirect::to(url('login'));
	}
}
