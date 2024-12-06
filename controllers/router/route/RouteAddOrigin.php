<?php 

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddOrigin extends Route {
    private $controller;

    public function __construct($controller) {
        $this->controller = new UnitController;
    }

    public function get($params = []) : void {
        $this->controller->displayAddUnitOrigin();
    }
    public function post($params = []) : void {

    }
}

?>