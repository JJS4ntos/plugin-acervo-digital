<?php

//Set te base url to access endpoints
define('URL_SCOPE', 'sd-api/v1');

//Setup vue js to use with frontend
add_action('admin_enqueue_scripts', function(){
  wp_enqueue_script( 'sd-view', SD_PATH . 'views/libs/vue.js' );
});

//Setup page on admin menu
add_action('admin_menu', 'super_dashboard_page_setup');

function super_dashboard_page_setup(){
  add_menu_page( 'Super Dashboard', 'Super Dashboard', 'manage_options', 'super-dashboard', 'page_resource', 'dashicons-image-filter', 3 );
}

function page_resource(){
  //echo file_get_contents( SD_PATH . 'frontend/dist/index.html' );
  echo '<h1>Esta página será substituída</h1>';
}
