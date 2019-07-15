<?php
namespace Controllers;

class Controller {

  protected function generateView(String $view_file, array $variables) {
    extract($variables);
    include( SD_PLUGIN_PATH . $view_file . '.php' );
  }

}
