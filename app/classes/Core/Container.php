<?php

namespace App\Classes\Core;

class Container {

  protected static $registry = array();

  public function __construct(){

  }
  /**
   * Register dependecy.
   * @param  String $name    
   * @param  Closure $resolve 
   * @return null          
   */
  public static function register($name, $resolve){
    self::$registry[$name] = $resolve;
  }

  /**
   * Resolve object if registered.
   * @param  String $name 
   * @return mixed       
   */
  public static function resolve($name){
    if(self::registered($name)){
      $instance = self::$registry[$name];
      return $instance();
    }
    throw new \Exception('Could not resolve ' . $name);
  }

  /**
   * Check if dependency is registered.
   * @param  String $name 
   * @return Boolean       
   */
  protected static function registered($name) {
    return array_key_exists($name, self::$registry);
  }
}
