<?php

namespace App\Views;

class View {

  public function __construct(){
    
  }
  /**
   * Display the view from path specified.
   * @param  string $path   
   * @param  array  $params 
   * @return $this         For chaining.
   */
  public function make($path = '', $params = array()){
    $path = ltrim($path, '/');
  	if(file_exists(app_path('views/' . $path . '.php'))){
  		extract($params, \EXTR_PREFIX_SAME, 'wddx');
  		require_once app_path('views/' . $path . '.php');
  	}
    return $this;
  }
}
