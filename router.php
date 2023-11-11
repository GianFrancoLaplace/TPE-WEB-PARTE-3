<?php
require_once 'config.php';
require_once 'libs/router.php';

$router = new Router();

#                 endpoint      verbo     controller           método
$router->addRoute('gimnasio', 'GET', 'ProductApiController', 'get'); # TaskApiController->get($params)
$router->addRoute('gimnasio', 'POST', 'ProductApiController', 'create');
$router->addRoute('gimnasio/:ID', 'GET', 'ProductApiController', 'get');
$router->addRoute('gimnasio/:ID', 'PUT', 'ProductApiController', 'update');
$router->addRoute('gimnasio/:ID', 'DELETE', 'ProductApiController', 'delete');

//$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken'); # UserApiController->getToken()

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);