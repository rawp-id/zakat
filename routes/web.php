<?php

use Routes\Router;

require_once __DIR__ . '/../routes/Route.php';
require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../app/http/controllers/ZakatController.php';
require_once __DIR__ . '/../app/http/controllers/UserController.php';
require_once __DIR__ . '/../app/http/controllers/auth/Login.php';

$router = new Router();

$router->addRoute('/api/zakat', 'ZakatController@index', 'GET');
$router->addRoute('/api/zakat/add', 'ZakatController@add', 'POST');

$router->addRoute('/api/login', 'LoginController@login', 'POST');

$router->addRoute('/api/user', 'UserController@index', 'GET');

$router->addRoute('/', '', 'GET', '/../views/layout/index.html');

return $router;
