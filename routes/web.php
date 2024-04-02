<?php

use Routes\Router;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routes/Route.php';
require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../app/http/controllers/ZakatController.php';
require_once __DIR__ . '/../app/http/controllers/UserController.php';
require_once __DIR__ . '/../app/http/controllers/auth/Login.php';
require_once __DIR__ . '/../app/http/controllers/auth/Register.php';
require_once __DIR__ . '/../app/http/controllers/auth/AuthController.php';

$router = new Router();

$router->addRoute('/api/zakat', 'ZakatController@index', 'GET');
$router->addRoute('/api/zakat/add', 'ZakatController@add', 'POST');

$router->addRoute('/api/login', 'LoginController@login', 'POST');
$router->addRoute('/api/register', 'RegisterController@register', 'POST');
$router->addRoute('/api/login-google', 'AuthController@redirectToGoogle', 'GET');
$router->addRoute('/api/callback-google', 'AuthController@handleGoogleCallback', 'GET');
$router->addRoute('/api/logout-google', 'AuthController@logout', 'GET');

$router->addRoute('/api/user', 'UserController@index', 'GET');

$router->addRoute('/', '', 'GET', '/../views/layout/index.html');

return $router;
