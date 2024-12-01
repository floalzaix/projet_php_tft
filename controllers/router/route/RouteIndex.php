<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteIndex extends Route {
    private MainController $controller;
    public function __construct($controller) {
        $this->controller = new MainController();
    }

    public function get($params = []) : void {
        $this->controller->index();
    }

    public function post($params = []) : void {
        $this->controller->index();
    }
}

?>