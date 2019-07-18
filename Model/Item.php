<?php
namespace Model;

class Item {

    public function getItems() {
      $result = json_decode( file_get_contents('http://memoriafredericomorais.com.br/api/item.php?t=123') );
      return $result;
    }

    public function getItem($id) {
      $result = json_decode( file_get_contents('http://memoriafredericomorais.com.br/api/item.php?t=123&itemId='.$id) );
      return $result;
    }

    public function getColecao($id) {
      $result = json_decode( file_get_contents('http://memoriafredericomorais.com.br/api/collection.php?t=123&colecaoId='.$id) );
      return $result;
    }

    public function getGrupo($id) {
      $result = json_decode( file_get_contents('http://memoriafredericomorais.com.br/api/group.php?t=123&groupId='.$id) );
      return $result;
    }

}
