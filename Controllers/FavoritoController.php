<?php
namespace Controllers;

use Controllers\Controller;

class FavoritoController extends Controller {

  public function meusFavoritos( $atts = false ) {
    return $this->generateView('frontend/download-file', array());
  }

}
