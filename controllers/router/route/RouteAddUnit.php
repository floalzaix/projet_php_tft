<?php 

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddUnit extends Route {
    private $controller;

    public function __construct($controller) {
        $this->controller = new UnitController;
    }

    public function get($params = []) : void {
        $this->controller->displayAddUnit();
    }
    public function post($params = []) : void {

    }
}

?>