<?php
/**
 * Route controllers to execute functions according urls.
 */

use Controllers\RouterController;

$controller = new RouterController();

$controller->get('/lead/add', 'LeadController@add');
