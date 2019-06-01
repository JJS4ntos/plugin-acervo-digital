<?php

class Lead {

  private $name, $email;

  public function __construct($args){
    $this->name = $args['name'];
    $this->email = $args['email'];
  }

}
