<?php
/**
 * Route controllers to execute functions according urls.
 */

use Controllers\RouterController;
use ShortCodes\Register;

$register = new Register();

$router = new RouterController();
$router->post('/solicitar-acesso', 'SolicitacaoController@solicitarAcesso');
$router->post('/solicitar-download', 'SolicitacaoController@solicitarDownload');
