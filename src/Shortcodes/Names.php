<?php
  namespace App\Shortcodes;

  trait Names {

    public $names = [
        'items' => 'ItemController@load',
        'item_single' => 'ItemController@view',
        'download_item' => 'ItemController@download',
        'meus-favoritos' => 'FavoritoController@meusFavoritos',
        'filtro' => 'ItemController@filtro'
    ];

  }
