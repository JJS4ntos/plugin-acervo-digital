<?php
/**
 * Route controllers to execute functions according urls.
 */
namespace App;

use App\Controllers\RouterController;
use App\Shortcodes\Register;

$register = new Register();

$router = new RouterController();
$router->post('/solicitar-acesso', 'SolicitacaoController@solicitarAcesso');
$router->post('/solicitar-download', 'SolicitacaoController@solicitarDownload');
$router->post('/favoritar-item', 'FavoritoController@favoritar');
$router->post('/desfavoritar-item', 'FavoritoController@desfavoritar');
$router->post('/solicitar-login', 'SolicitacaoController@solicitarLogin');
