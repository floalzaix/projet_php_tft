<?php

require_once("helpers/psr4_autoloader_class.php");

$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace("\League\Plates", "/vendor/plates-3.6.0/src");
$loader->addNamespace("\Controllers", "/controllers");
$loader->addNamespace("\Models", "/models");
$loader->addNamespace("\Config", "/config");
$loader->addNamespace("\Controllers\Router", "/controllers/router");
$loader->addNamespace("\Controllers\Router\Route", "/controllers/router/route");

use Controllers\Router\Router;
$router = new Router();

/*$main_controller = new Controllers\MainController();
$main_controller->index();*/

$router->routing($_GET, $_POST);


?>