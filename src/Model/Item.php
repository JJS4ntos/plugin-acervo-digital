<?php
namespace App\Model;

class Item {

    private $host= 'memoriafredericomorais.com.br';
    //private $host= 'localhost/AppGini';

    public function getItems($page = false) {
      $result = '';
      if( $page ) {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&page='.$page.'&rows=10') );
      } else {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123') );
      }
      return $result;
    }

    public function getItem($id) {
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&itemId='.$id) );
      return $result;
    }

    public function getTotalItems() {
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&count=true') );
      return $result;
    }

    public function getColecao($id) {
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/collection.php?t=123&colecaoId='.$id) );
      return $result;
    }

    public function getGrupo($id) {
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/group.php?t=123&groupId='.$id) );
      return $result;
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
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&serieId=' . $item->serie_codigo) );
      return $result;
    }

}
