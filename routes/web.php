<?php

use Routes\Router;

require_once __DIR__ . '/../routes/Route.php';
require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../app/Http/Controller/ZakatController.php';

$router = new Router();

$router->addRoute('/api/zakat', 'ZakatController@index', 'GET');

return $router;
