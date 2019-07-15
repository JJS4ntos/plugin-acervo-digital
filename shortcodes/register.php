<?php
  namespace Shortcodes;

  use Shortcodes\Names;
  //use Controllers\ItemController;


  /*
  *   Register shortcode and link to function in controller;
  */
  class Register {

    use Names;

    public function __construct() {
      foreach ($this->names as $name => $function) {
        $this->install($name, $function);
      }
    }

    public function install($name, $function) {
      $meta = explode('@', $function);
      $class = 'Controllers\\'.$meta[0];
      add_shortcode( $name, array( new $class, $meta[1] ) );
    }

  }
