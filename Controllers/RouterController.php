<?php

namespace Controllers;

class RouterController {

  public function get($url, $callback){
    $this->resolveCallback($url, $callback, 'GET');
  }

  public function post($url, $callback){
    $this->resolveCallback($url, $callback, 'POST');
  }

  /*
    Retornaa funcção correspondente ao callback indicado seguindo o formato:
    function@controller
  */
  private function resolveCallback(String $url, String $callback, String $method){
    try {
      $meta = explode('@', $callback);
      $class = 'Controllers\\'.$meta[1];
      $controller = new $class();
      add_action('admin_menu', function() use($controller, $meta, $method, $url){
        register_rest_route(URL_SCOPE, $url, [
          'methods' => $method,
          'callback' => call_user_func( array( $controller, $meta[0] ) )
        ]);
      });
    } catch (Exception $e) {
      die('Cannot read callback like that');
    }
  }

}
