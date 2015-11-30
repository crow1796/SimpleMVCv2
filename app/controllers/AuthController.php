<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Classes\Utils\Input;
use App\Classes\Utils\Redirect;
use App\Classes\Validator\Factories\ValidatorFactory;
use App\Classes\Utils\Session;
use App\Models\User;
use App\Classes\Utils\Hash;
use App\Classes\Utils\Globals;
use App\Classes\Databases\Contracts\DatabaseInterface;
use App\Classes\Auth\Authenticator;

class AuthController extends Controller{
	public function __construct(DatabaseInterface $database){
		parent::__construct($database);
		$this->middleware('App\Classes\Middlewares\Auth\RedirectIfAuthenticated');
	}

	public function getLogin(){
		view('auth/login');
	}

	public function postLogin(){
		$rules = array(
				'username' => ['required' => true,
								'min' => 2],
				'password' => ['required' => true,
								'min' => 2]
			);
		$validation = ValidatorFactory::make(Input::all(), $rules, $this->database->getConnection());
		if($validation->passes()){
			$authenticator = new Authenticator($this->database->getConnection());
			$authenticator->attempt('username', ['username' => Input::get('username'), 'password' => Input::get('password')]);
		}
		Session::flash('errors', $validation->errors());
		Redirect::to('?controller=AuthController&action=getLogin');
	}

	public function getRegister(){
		view('auth/register');
	}

	public function postRegister(){
		$rules = array(
				'username'			=> 	['required' => true,
											'min' => 2,
											'max' => 18,
											'unique' => 'App\Models\User'],
				'password'			=> ['required' => true,
											'min' => 2,
											'max' => 18],
				'confirm-password'	=> ['required' => true,
											'confirmed' => Input::get('password')],
				'firstname'			=> ['required' => true],
				'lastname'			=> ['required' => true],
				'email'				=> ['required' => true,
											'email' => true],
				'address'			=> ['required' => true,
											'min' => 2]
			);
		$validation = ValidatorFactory::make(Input::all(), $rules, $this->database->getConnection());
		if($validation->passes()){
			$user = new User($this->database->getConnection());
			$created = $user->create(array(
							'username' => Input::get('username'),
							'password' => Hash::make(Input::get('password')),
							'name' => Input::get('firstname') . ' ' . Input::get('lastname'),
							'address' => Input::get('address')
				));

			$messages[] = 'Congratulations! You have created an account successfully!';
			$messages[] = 'You can now login.';
			Session::flash('messages', $messages);
			Redirect::to('?controller=AuthController&action=getLogin');
		}

		Session::flash('errors', $validation->errors());
		Redirect::to('?controller=AuthController&action=getRegister');
	}
}