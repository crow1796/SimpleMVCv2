<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Classes\Databases\Contracts\DatabaseInterface;

class PagesController extends Controller{

	protected $className = __CLASS__;

	public function __construct(DatabaseInterface $database){
		parent::__construct($database);
		$this->middleware('App\Classes\Middlewares\Auth\RedirectIfNotAuthenticated');
	}

	public function home(){
		view('pages/index');
	}
}