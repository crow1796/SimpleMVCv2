<?php

namespace App\Classes\Utils;

class Cookies{
  public static function set($name, $value, $exp){
    return setcookie($name, $value, time() + $exp);
  }

  public static function get($name){
    return $_COOKIE[$name];
  }

  public static function has($name){
    return isset($_COOKIE[$name]);
  }

  public static function delete($name){
    return setcookie($name, '', time() - (60*60*60*7*30));
  }
}
