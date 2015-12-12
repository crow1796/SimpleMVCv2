<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Classes\Databases\Contracts\DatabaseInterface;
use App\Views\View;

class PagesController extends Controller{

	protected $className = __CLASS__;

	public function __construct(){
		parent::__construct();
		$this->middleware('App\Classes\Middlewares\Auth\RedirectIfNotAuthenticated');
	}

	public function index(){
		$this->view->make('pages/index');
	}
}
