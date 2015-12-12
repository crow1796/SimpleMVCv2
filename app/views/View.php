<?php

namespace App\Views;

class View {

  public function __construct(){
    
  }

  public function make($path = '', $params = array()){
    $path = ltrim($path, '/');
  	if(file_exists(app_path('views/' . $path . '.php'))){
  		extract($params, \EXTR_PREFIX_SAME, 'wddx');
  		require_once app_path('views/' . $path . '.php');
  	}
    return $this;
  }
}
