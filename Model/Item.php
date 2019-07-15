<?php
namespace Model;

class Item {

    public function getItems() {
      $result = json_decode( file_get_contents('http://localhost/AppGini/api/item.php?t=123') );
      return $result;
    }

    public function getItem($id) {
      $result = json_decode( file_get_contents('http://localhost/AppGini/api/item.php?t=123&itemId='.$id) );
      return $result;
    }

    public function getColecao($id) {
      $result = json_decode( file_get_contents('http://localhost/AppGini/api/collection.php?t=123&colecaoId='.$id) );
      return $result;
    }

    public function getGrupo($id) {
      $result = json_decode( file_get_contents('http://localhost/AppGini/api/group.php?t=123&groupId='.$id) );
      return $result;
    }

}
