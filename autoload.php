<?php
spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class . '.php');
    if( file_exists( plugin_dir_path(__FILE__) . $file ) ) {
      require_once $file;
    }
});
?>
