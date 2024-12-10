<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Exception;

class RouteIndex extends Route {
    private MainController $controller;
    public function __construct($controller) {
        $this->controller = new MainController();
    }

    public function get($params = []) : void {
        if (isset($params["del_unit"]) && $params["del_unit"]) {
            $this->controller->index(true, $params["id"]);
        } else {
            $this->controller->index();
        }
    }

    public function post($params = []) : void {
        $message = "Unité supprimée avec succés";
        try {
            if (isset($params["confirm_button"])) {
                $this->controller->delUnit($params["id"]);
            } else {
                $message = "";
            }
        } catch (Exception $error) {
            $message = $error->getMessage();
        }
        $this->controller->index(true, "", $message);
    }
}

?>