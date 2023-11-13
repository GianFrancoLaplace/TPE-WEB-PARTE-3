<?php
require_once 'config.php';
require_once 'libs/router.php';

require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/auth.api.controller.php';
require_once 'app/controllers/resenia.api.controller.php';

$router = new Router();

$router->addRoute("auth", "POST", "AuthApiController", "login");

#                 endpoint      verbo     controller           método
$router->addRoute('productos', 'GET', 'ProductApiController', 'get'); # ProductApiController->get($params)
$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'get');
$router->addRoute('productos', 'POST', 'ProductApiController', 'create');
$router->addRoute('productos/:ID', 'PUT', 'ProductApiController', 'update');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'delete');

$router->addRoute('resenias', 'GET', 'ReseniaApiController', 'get'); 
$router->addRoute('resenias/:ID', 'GET', 'ReseniaApiController', 'get');
$router->addRoute('resenias', 'POST', 'ReseniaApiController', 'create');
$router->addRoute('resenias/:ID', 'DELETE', 'ReseniaApiController', 'delete');

$router->addRoute('user/:token', 'GET', 'AuthApiController', 'getToken'); # AuthApiController->getToken()

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);