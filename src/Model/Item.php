<?php
namespace App\Model;

class Item {

    //private $host= 'memoriafredericomorais.com.br';
    public $host = '45.76.12.210';
    private $except_args = ['l', 'r'];

    public function getHost() {
      return $this->host;
    }

    public function queryBuilder( array $args ) {
      $query = '';
      foreach( $args as $parameter => $value ) {
        if( !in_array( $parameter, $this->except_args ) ) {
          //if( !$query) ) {
            /*$query = "?{$parameter}={$value}";
          } else { */
            $query .= "&{$parameter}={$value}";
          //}
        }
      }
      return str_replace(' ', '%20', $query);
    }

    public function getItems( $page = false, array $args = array() ) {
      $result = '';
      $query = $this->queryBuilder($args);
      if( $page ) {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&page='.$page.'&rows=10' . $query ) );
      } else {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123' . $query ) );
      }
      return $result;
    }

    public function getItem($id) {
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&itemId='.$id) )->result;
      return $result;
    }

    public function getTotalItems() {
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&count=true') );
      return $result;
    }

    public function getColecao($id = false) {
      $result = '';
      if( $id ) {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/collection.php?t=123&colecaoId='.$id) );
      }else {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/collection.php?t=123') );
      }
      return $result;
    }

    public function getGrupo($id = false) {
      $result = '';
      if($id) {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/group.php?t=123&groupId='. $id .'&page=1&rows=1000') );
      } else {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/group.php?t=123&page=1&rows=1000') );
      }
      return $result;
    }

    public function getSerie($id = false) {
      $result = '';
      if($id) {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/serie.php?t=123&serieId='. $id .'&page=1&rows=1000') );
      } else {
        $result = json_decode( file_get_contents('http://'. $this->host .'/api/serie.php?t=123&page=1&rows=1000') );
      }
      return $result;
    }

    public function getUploadImage( $item , $force_placeholder = false) {
      $uploads = '';
      if( isset($item->uploads) ) {
        $uploads = json_decode( $item->uploads )->images;
      }
      $image = 'http://'. $this->host .'/acervo/wp-content/uploads/2019/07/placeholder-600x400.png';
      if( $force_placeholder ) {
          return $image;
      }
      if(is_array($uploads)) {
        foreach ($uploads as $key => $upload) {
          if($key == 0) {
            $image = 'http://'. $this->host .'/arquivos/images/th/'. str_replace('.pdf', '_th.jpg', $upload->fileName);
          }
          if($upload->defaultImage) {
            $image = 'http://'. $this->host .'/arquivos/images/th/'. str_replace('.pdf', '_th.jpg', $upload->fileName);
          }
        }
      }
      return $image;
    }

    public function getUploadImages( $item, $force_placeholder = false ) {
      if( $force_placeholder ) {
        return array('http://'. $this->host .'/acervo/wp-content/uploads/2019/07/placeholder-600x400.png');
      }
      $uploads = '';
      if( isset($item->uploads) ) {
        $uploads = json_decode( $item->uploads )->images;
      }
      $images = array();
      if( is_array($uploads) ) {
        foreach ($uploads as $upload) {
          $images[] = 'http://'. $this->host .'/arquivos/images/th/'. str_replace('.pdf', '_th.jpg', $upload->fileName);
        }
      }
      return $images;
    }

    public function getRelationItems( $item ){
      $result = json_decode( file_get_contents('http://'. $this->host .'/api/item.php?t=123&serieId=' . $item->serie_codigo . '&page=1&rows=4') )->result;
      return $result;
    }

}
