<?php
namespace Controllers;

class Controller {

  protected function generateView(String $view_file, array $variables) {
    extract($variables);
    $f = $this->loadViewFile( SD_PLUGIN_PATH . $view_file . '.php' );
    return $f;
  }

  protected function loadViewFile($file){

    $file = file_get_contents($file);
    return eval($file);

  }

}
