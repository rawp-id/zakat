<?php

use Routes\Router;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routes/Route.php';
require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../app/Http/Controllers/ZakatController.php';
require_once __DIR__ . '/../app/Http/Controllers/UserController.php';
require_once __DIR__ . '/../app/Http/Controllers/PageController.php';
require_once __DIR__ . '/../app/Http/Controllers/Auth/Login.php';
require_once __DIR__ . '/../app/Http/Controllers/Auth/Register.php';
require_once __DIR__ . '/../app/Http/Controllers/Auth/AuthController.php';

$router = new Router();

$router->addRoute('/api/zakat', 'ZakatController@index', 'GET');
$router->addRoute('/api/zakat', 'ZakatController@add', 'POST');
$router->addRoute('/api/zakat/verif', 'ZakatController@accZakat', 'POST');

$router->addRoute('/api/login', 'LoginController@login', 'POST');
$router->addRoute('/api/register', 'RegisterController@register', 'POST');
$router->addRoute('/api/login-google', 'AuthController@redirectToGoogle', 'GET');
$router->addRoute('/api/callback-google', 'AuthController@handleGoogleCallback', 'GET');
$router->addRoute('/api/logout-google', 'AuthController@logout', 'GET');
$router->addRoute('/api/verifikasi', 'AuthController@verifikasi', 'POST');

$router->addRoute('/api/user', 'UserController@index', 'GET');
$router->addRoute('/api/user/kode', 'UserController@setKode', 'POST');

$router->addRoute('/dashboard', 'PageController@dashboard', 'GET');
$router->addRoute('/form', 'PageController@form', 'GET');
$router->addRoute('/form', 'PageController@form', 'POST');
$router->addRoute('/table', 'PageController@table', 'GET');
$router->addRoute('/verifikasi-zakat', 'PageController@table_verif', 'GET');
$router->addRoute('/verifikasi-zakat', 'PageController@table_verif', 'POST');
$router->addRoute('/login', 'PageController@login', 'GET');
$router->addRoute('/login', 'PageController@login', 'POST');
$router->addRoute('/register', 'PageController@register', 'GET');
$router->addRoute('/verifikasi', 'PageController@verifikasi', 'GET');
$router->addRoute('/verifikasi', 'PageController@verifikasi', 'POST');
$router->addRoute('/logout', 'PageController@logout', 'GET');
$router->addRoute('/kode-masjid', 'PageController@kodeMs', 'GET');
$router->addRoute('/kode-masjid', 'PageController@kodeMs', 'POST');

// $router->addRoute('/', '', 'GET', '/../views/template/index.html');
$router->addRoute('/maintenance', '', 'GET', '/../storage/maintenance.html');

return $router;
