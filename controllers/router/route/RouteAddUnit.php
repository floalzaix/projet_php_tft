<?php 

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\UnitController;
use Exception;

class RouteAddUnit extends Route {
    private UnitController $controller;

    public function __construct($controller) {
        $this->controller = new UnitController;
    }

    public function get($params = []) : void {
        $this->controller->displayAddUnit();
    }
    public function post($params = []) : void {
        $message = "L'unité à été crée avec succés";
        try {
            $this->controller->addUnit(
                parent::getParam($params, "name", false),
                parent::getParam($params, "cost", false),
                parent::getParam($params, "origin", false),
                parent::getParam($params, "url_img", false)
            );
        } catch (Exception $error) {
            $message = $error->getMessage();
        }
        $this->controller->displayAddUnit($message);
    }
}

?>