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
use App\Classes\Utils\Token;

class AuthController extends Controller{

	protected $className = __CLASS__;

	public function __construct(DatabaseInterface $database){
		parent::__construct($database);
		$this->middleware('App\Classes\Middlewares\Auth\RedirectIfAuthenticated', ['except' => ['getLogout', 'getRegister']]);
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
				'age'				=> ['required' => true],
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
							'age' => Input::get('age'),
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

	public function getLogout(){
		if(Token::match(Input::get(Globals::TOKEN_NAME))){
			$authenticator = new Authenticator($this->database->getConnection());
			$authenticator->logoutUser();
		}
	}
}