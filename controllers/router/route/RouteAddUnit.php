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
        $this->controller->displayAddUnit("", $params["id"] ?? null);
    }
    public function post($params = []) : void {
        $message = "L'unité a été crée avec succés";
        try {
            $origins = [
                parent::getParam($params, "origin1"),
                parent::getParam($params, "origin2"),
                parent::getParam($params, "origin3")
            ];
            if (($origins[0] == $origins[1] && $origins[1] != "NULL") || ($origins[0] == $origins[2] && $origins[2] != "NULL") || ($origins[1] == $origins[2] && $origins[2] != "NULL")) {
                throw new Exception("Une unité ne peut pas avoir plusieurs fois la même origine");
            }
            
            $this->controller->addUnit(
                parent::getParam($params, "name", false),
                parent::getParam($params, "cost", false),
                $origins,
                parent::getParam($params, "url_img", false)
            );
        } catch (Exception $error) {
            $message = $error->getMessage();
        }
        $this->controller->displayAddUnit($message, $params["id"] ?? null);
    }
}

?>