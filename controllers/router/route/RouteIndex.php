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
            $this->controller->index(["del_unit" => true, "id" => $params["id"] ?? null]);
        } else {
            $this->controller->index(["message" => $params["message"] ?? ""]);
        }
    }

    public function post($params = []) : void {
        $message = "";
        try {
            if (isset($params["edit_unit"])) {
                $message = "Unité modifié avec succés";
                $this->controller->editUnit(
                    parent::getParam($params, "name", false),
                    parent::getParam($params, "cost", false),
                    parent::getParam($params, "origin", false),
                    parent::getParam($params, "url_img", false),
                    $params["id"] ?? null
                );
            } elseif (isset($params["edit_unit"]) && isset($params["confirm_button"])) {
                $message = "Unité supprimée avec succés";
                $this->controller->delUnit($params["id"]);
            }
        } catch (Exception $error) {
            $message = $error->getMessage();
        }
        $this->controller->index(["message" => $message]);
    }
}

?>