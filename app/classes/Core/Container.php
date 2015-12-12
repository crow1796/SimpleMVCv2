<?php

namespace App\Classes\Core;

class Container {

  protected static $registry = array();

  public function __construct(){

  }

  public static function register($name, $resolve){
    self::$registry[$name] = $resolve;
  }

  public static function resolve($name){
    if(self::registered($name)){
      $instance = self::$registry[$name];
      return $instance();
    }
    throw new \Exception('Could not resolve ' . $name);
  }

  protected static function registered($name) {
    return array_key_exists($name, self::$registry);
  }
}
