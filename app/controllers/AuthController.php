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
use App\Views\View;
use App\Classes\Core\Container;

class AuthController extends Controller{
	protected $className = __CLASS__;

	public function __construct(){
		parent::__construct();
		$this->middleware('App\Classes\Middlewares\Auth\RedirectIfAuthenticated', ['except' => ['getLogout', 'getRegister']]);
	}

	public function getLogin(){
		$this->view->make('auth/login');
	}

	public function postLogin(){
		$rules = array(
				'username' => ['required' => true,
								'min' => 2],
				'password' => ['required' => true,
								'min' => 2]
			);
		$validation = ValidatorFactory::make(Input::all(), $rules);
		if($validation->passes()){
			$authenticator = new Authenticator();
			$authenticator->attempt('username', ['username' => Input::get('username'), 'password' => Input::get('password')]);
		}
		Session::flash('errors', $validation->errors());
		Redirect::to(url('login'));
	}

	public function getRegister(){
		$this->view->make('auth/register');
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
		$validation = ValidatorFactory::make(Input::all(), $rules);
		if($validation->passes()){
			$user = new User();
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
			Redirect::to(url('login'));
		}

		Session::flash('errors', $validation->errors());
		Redirect::to(url('register'));
	}

	public function getForgotPassword(){
		$this->view->make('auth/forgot');
	}

	public function postForgotPassword(){
		$rules = [
			'username'	=> ['required' => true,
											'min' => 2],
			'email'			=> ['required' => true,
												'email' => true]
		];

		$validation = ValidatorFactory::make(Input::all(), $rules);
		if($validation->passes()){
			echo Input::get('username') . '<br/>' . Input::get('email');
		}

		Session::flash('errors', $validation->errors());
		Redirect::to(url('forgot-password'));
	}

	public function getLogout(){
		if(Token::match(Input::get(Globals::TOKEN_NAME))){
			$authenticator = new Authenticator();
			$authenticator->logoutUser();
		}
	}

	public function sampleAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			// $data = ['One', 'Two', 'Three'];
			// echo json_encode($data);

			$data = '[{"id" : 1, "name": "Ododz"}, {"id" : 2, "name" : "Gwapodz"}]';
			echo json_encode(json_decode($data));
			return true;
		}
	}

	public function sample($slug){
		echo $slug;
	}
}
