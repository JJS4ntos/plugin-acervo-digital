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
    $items = $itemModel->getItems();
    $result = '';
    foreach( $items as $item ) {
      $result .= $this->build( $item );
    }
    return $result;
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
        return $this->generateView('single-item', array('item' => $item, 'images' => $images, 'itemModel' => $itemModel) );
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
