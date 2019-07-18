<?php
namespace Controllers;

use Controllers\Controller;
use Model\Item;

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
    return $this->generateView( 'frontend/items', array('link' => $link, 'item' => $item) );
  }

  public function view() {
    $itemModel = new Item();
    if( isset( $_GET['id'] ) ) {
        $item = $itemModel->getItem($_GET['id'])[0];
        $this->generateView('frontend/single-item', array('item' => $item) );
    }
  }

  public function getUploadImage( $item ) {
    $uploads = json_decode( $item->uploads )->images;
    $image = 'http://memoriafredericomorais.com.br/acervo/wp-content/uploads/2019/07/placeholder-600x400.png';
    if(is_array($uploads)) {
      foreach ($uploads as $key => $upload) {
        if($key == 0) {
          $image = 'http://acervofredericomorais.com.br/arquivos/images/th/'. str_replace('.pdf', '_th.jpg', $upload->fileName);
        }
        if($upload->defaultImage) {
          $image = 'http://acervofredericomorais.com.br/arquivos/images/th/'. str_replace('.pdf', '_th.jpg', $upload->fileName);
        }
      }
    }
    return $image;
  }

  public function getUploadImages( $item ) {
    $uploads = json_decode( $item->uploads )->images;
    $images = array();
    if(is_array($uploads)) {
      foreach ($uploads as $upload) {
        $images[] = 'http://acervofredericomorais.com.br/arquivos/images/th/'. str_replace('.pdf', '_th.jpg', $upload->fileName);
      }
    }
    return $images;
  }

  public function getRelationItems( $item ){
    $result = json_decode( file_get_contents('http://memoriafredericomorais.com.br/api/item.php?t=123&serieId=' . $item->serie_codigo) );
    return $result;
  }

  public function download( $atts = null ) {
    if($_GET['item']) {
        $user = wp_get_current_user();
        $this->generateView('frontend/download-file', array('user' => $user));
    }else {
      echo 'Erro ao procurar arquivo para download';
    }
  }

  public function downloadFile() {

  }

}
