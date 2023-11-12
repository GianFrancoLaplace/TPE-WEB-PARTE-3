<?php
require_once 'config.php';
require_once 'libs/router.php';

$router = new Router();

#                 endpoint      verbo     controller           método
$router->addRoute('productos', 'GET', 'ProductApiController', 'get'); # TaskApiController->get($params)
$router->addRoute('productos', 'POST', 'ProductApiController', 'create');
$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'get');
$router->addRoute('productos/:ID', 'PUT', 'ProductApiController', 'update');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'delete');

//$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken'); # UserApiController->getToken()

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);