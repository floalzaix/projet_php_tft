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
        $this->controller->displayAddUnit(["id" => $params["id"] ?? null]);
    }
    public function post($params = []) : void {
        //Unit creation
        $message = "L'unité a été crée avec succés"; 
        $error = false; //True if the process faces a failure
        try {
            $origins = [
                parent::getParam($params, "origin1"),
                parent::getParam($params, "origin2"),
                parent::getParam($params, "origin3")
            ];
            //Test if there is twice the same origin
            if (($origins[0] == $origins[1] && $origins[1] != "NULL") || ($origins[0] == $origins[2] && $origins[2] != "NULL") || ($origins[1] == $origins[2] && $origins[2] != "NULL")) {
                throw new Exception("Une unité ne peut pas avoir plusieurs fois la même origine");
            }
            
            $this->controller->addUnit(
                parent::getParam($params, "name", false),
                parent::getParam($params, "cost", false),
                $origins,
                parent::getParam($params, "url_img", false)
            );
        } catch (Exception $err) {
            $message = $err->getMessage(); //Handles exceptions to be displayed on the screen
            $error = true;
        }
        $this->controller->displayAddUnit(["message" => $message, "error" => $error, "id" => $params["id"] ?? null]);
    }
}

?>