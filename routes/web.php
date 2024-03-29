<?php

use Routes\Router;

require_once __DIR__ . '/../routes/Route.php';
require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../app/Http/Controller/ZakatController.php';
require_once __DIR__ . '/../app/Http/Controller/UserController.php';

$router = new Router();

$router->addRoute('/api/zakat', 'ZakatController@index', 'GET');
$router->addRoute('/api/zakat/add', 'ZakatController@add', 'POST');

$router->addRoute('/api/user', 'UserController@index', 'GET');

return $router;
