<?php
/**
 * Route controllers to execute functions according urls.
 */

use Controllers\RouterController;
use Shortcodes\Register;

$register = new Register();

$router = new RouterController();
$router->post('/solicitar-acesso', 'SolicitacaoController@solicitarAcesso');
$router->post('/solicitar-download', 'SolicitacaoController@solicitarDownload');
