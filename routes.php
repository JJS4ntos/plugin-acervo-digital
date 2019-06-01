<?php

use Controllers\RouterController;

$controller = new RouterController();

$controller->get('/lead/add', 'add@LeadController');
