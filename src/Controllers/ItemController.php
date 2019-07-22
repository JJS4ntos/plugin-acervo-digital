<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Model\Item;

class ItemController extends Controller{

  /*
    Load items from api
  */
  public function load( $atts = null ) {
    $itemModel = new Item();
    $page = $_GET['l'];
    $items = $itemModel->getItems($page);
    $result = '';
    $pages = $itemModel->getTotalItems()[0]->total / 10;
    $pagination = $this->generateView( 'pagination', array('pages' => $pages) );
    foreach( $items as $item ) {
      $result .= $this->build( $item );
    }
    return $result . $pagination;
  }

  public function build( $item ) {
    $livro = get_page_by_title('Livro');
    $link = get_page_link( $livro->ID );
    $itemModel = new Item();
    return $this->generateView( 'items', array('link' => $link, 'item' => $item, 'thumbnail' => $itemModel->getUploadImage( $item )) );
  }

  public function view() {
    $itemModel = new Item();
    if( isset( $_GET['id'] ) ) {
        $item = $itemModel->getItem($_GET['id'])[0];
        $images = $itemModel->getUploadImages($item);
        $favorito = get_posts(
          array(
             'numberposts'	=> -1,
             'post_status' => 'private',
             'post_type'		=> 'favorito',
             'meta_key'		=> 'item_id',
             'meta_value'	=> $_GET['id']
          )
        );
        return $this->generateView('single-item', array(
            'item' => $item,
            'images' => $images,
            'itemModel' => $itemModel,
            'userId' => get_current_user_id(),
            'favorito' => $favorito
          )
        );
    }
  }

  public function download( $atts = null ) {
    if($_GET['item']) {
        $user = wp_get_current_user();
        return $this->generateView('download-file', array('user' => $user));
    }else {
      echo 'Erro ao procurar arquivo para download';
    }
  }

  public function downloadFile() {

  }

}
