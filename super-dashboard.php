<?php
/*
  Plugin Name: Super Dashboard
  Plugin URI: https://github.com/JJS4ntos
  Description: Gerencie todos os seus leads e tenha o perfil de cada um deles.
  Version: ALPHA
  Author: Jair Júnior
  Author URI: https://github.com/JJS4ntos
*/
// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('SD_PATH', plugin_dir_url( __FILE__ ));
define('SD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
require_once 'config/setup.php';
require_once 'database/install.php';
require_once 'autoload.php';
require_once 'routes.php';
