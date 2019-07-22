<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Model\Item;

class FavoritoController extends Controller {

  public function meusFavoritos( $atts = false ) {
    $itemModel = new Item();
    $link = get_page_link(25);
    $favoritos = get_posts(
      array(
    	   'numberposts'	=> -1,
         'post_status' => 'private',
    	   'post_type'		=> 'favorito',
         'meta_key'		=> 'user_id',
	       'meta_value'	=> get_current_user_id()
      )
    );
    $f_arr = array();
    foreach ($favoritos as $f) {
      $f_arr[] = $itemModel->getItem( get_post_meta( $f->ID, 'item_id' )[0] );
    }
    return $this->generateView('meus-favoritos', ['favoritos' => $f_arr, 'link' => $link]);
  }

  public function favoritar() {
    $itemId = $_POST['itemId'];
    $user_id = $_POST['userId'];
    $post_id = wp_insert_post([
      'post_title' => "Usuário {$user_id} favoritou {$itemId}",
      'post_type' => 'favorito',
      'post_status' => 'private'
    ]);
    update_post_meta( $post_id, 'user_id', $user_id);
    update_post_meta( $post_id, 'item_id', $itemId);
    return 'Favoritado com sucesso!';
  }

  public function desfavoritar() {
    $favoritoId = $_POST['favoritoId'];
    wp_delete_post( $favoritoId, true );
    return 'Desfavoritado com sucesso!';
  }

}
