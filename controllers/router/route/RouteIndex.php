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
        if (isset($params["del_unit"]) && $params["del_unit"]) { //Tests if the page is accessed in order to delete a unit
            $this->controller->index(["del_unit" => true, "id" => $params["id"] ?? null]); 
        } elseif (isset($params["del_origin"]) && $params["del_origin"]) {
            $this->controller->index(["del_origin" => true, "id" => $params["id"] ?? null]);
        } else {
            $this->controller->index(["message" => $params["message"] ?? ""]);
        }
    }

    public function post($params = []) : void {
        $message = ""; //Message that will be displayed on the screen when the submit button is pressed
        $error = false; //True if the process faces a failure
        try {
            if (isset($params["edit_unit"])) { //Tests if accessed in edit unit mode
                $message = "Unité modifié avec succés";
                $origins = [
                    parent::getParam($params, "origin1"),
                    parent::getParam($params, "origin2"),
                    parent::getParam($params, "origin3")
                ];
                if (($origins[0] == $origins[1] && $origins[1] != "NULL") || ($origins[0] == $origins[2] && $origins[2] != "NULL") || ($origins[1] == $origins[2] && $origins[2] != "NULL")) {
                    throw new Exception("Une unité ne peut pas avoir plusieurs fois la même origine");
                }

                $this->controller->editUnit(
                    parent::getParam($params, "name", false),
                    parent::getParam($params, "cost", false),
                    $origins,
                    parent::getParam($params, "url_img", false),
                    $params["id"] ?? null
                );
            } elseif (isset($params["del_unit"]) && isset($params["confirm_button"])) { //Tests if accessed in delete unit mode
                $message = "Unité supprimée avec succés";
                $this->controller->delUnit($params["id"] ?? null);
            } elseif (isset($params["edit_origin"])) { //Tests if accessed in edit origin mode
                $message = "Origine modifié avec succés !";
                $this->controller->editOrigin(
                    parent::getParam($params, "name", false),
                    parent::getParam($params, "url_img", false),
                    $params["id"] ?? null
                );
            } elseif (isset($params["del_origin"]) && isset($params["confirm_button"])) { //Tests if accessed in delete origin mode
                $message = "Origine supprimée avec succés !";
                $this->controller->delOrigin($params["id"] ?? null);
            }
        } catch (Exception $err) {
            $message = $err->getMessage(); //Gets the errors to be displayed in case of a failure of the process
            $error = true;
        }
        $this->controller->index(["message" => $message, "error" => $error]);
    }
}

?>