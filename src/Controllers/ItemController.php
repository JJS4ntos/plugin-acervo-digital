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
    $page = '';
    if( isset($_GET['l']) ) {
      $page = $_GET['l'];
    }
    $items = $itemModel->getItems($page, $_GET);
    $count = $items->count[0]->{'COUNT(*)'};
    $items = $items->result;
    $result = '';
    $pages = 1;
    //if( count($items) > 10 ) {
      //$pages = $itemModel->getTotalItems()[0]->total / 10;
      $pages = intval($count / 10);

    //}
    $pagination = $this->generateView( 'pagination', array('pages' => $pages) );
    foreach( $items as $item ) {
      $result .= $this->build( $item );
    }
    return $result . $pagination;
  }

  public function filtro( $atts = null ) {
    $itemModel = new Item();
    $colecoes = $itemModel->getColecao();
    $grupos = $itemModel->getGrupo();
    $series = $itemModel->getSerie();
    $page = get_queried_object();
    $page = get_page_link( $page->ID );
    return $this->generateView('filtro', array('colecoes' => $colecoes, 'grupos' => $grupos, 'series' => $series, 'page' => $page));
  }

  public function build( $item ) {
    $livro = get_page_by_title('Item');
    $link = get_page_link( $livro->ID );
    $itemModel = new Item();
    $userId = get_current_user_id();
    $favorito = get_posts(
      array(
         'numberposts'	=> -1,
         'post_status' => 'private',
         'post_type'		=> 'favorito',
         'meta_key'		=> 'item_id',
         'meta_value'	=> $item->id
      )
    );
    return $this->generateView( 'items',
      array(
        'link' => $link,
        'item' => $item,
        'thumbnail' => $itemModel->getUploadImage( $item ),
        'favorito' => $favorito,
        'userId' => $userId
      )
    );
  }

  public function view() {
    $itemModel = new Item();
    if( isset( $_GET['id'] ) ) {
        $item = $itemModel->getItem($_GET['id'])[0];
        $identificacao = $item->identificacao;
        $result = json_decode( file_get_contents('http://'. $itemModel->getHost() .'/api/item.php?t=123&identificacao=' . $identificacao) );
        $uploads = false;
        if( isset($result->uploads) ) {
            $uploads = json_decode($result->uploads);
            $uploads = $uploads->images;
        }
        $links = array();
        if( $uploads ) {
          foreach( $uploads as $upload ) {
            $link = 'http://acervofredericomorais.com.br/arquivos/images/upload/'. $upload->fileName;
            /*header('Content-Type: application/pdf');
            header("Content-Disposition: attachment; filename={$upload->fileName}.pdf");
            header('Pragma: no-cache');
            readfile($link);
            exit;*/
            $links[] = $link;
          }
        }
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
            'favorito' => $favorito,
            'links' => $links
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
