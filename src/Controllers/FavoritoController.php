<?php
namespace App\Controllers;

use App\Controllers\Controller;

class FavoritoController extends Controller {

  public function meusFavoritos( $atts = false ) {
    return $this->generateView('download-file', array());
  }

}
