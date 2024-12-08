<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteAddUnit;
use Controllers\Router\Route\RouteEr404;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddOrigin;
use Controllers\Router\Route\RouteSearch;
use Controllers\UnitController;
use Controllers\ErrorController;
use Exception;

class Router {
    private Array $route_list,  $ctrl_list;
    private String $action_key;

    public function __construct($name_of_action_key = "action") {
        $this->action_key = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList() : void {
        $this->ctrl_list = ["main" => new MainController(), 
                            "unit" => new UnitController(),
                            "error" => new ErrorController()];
    }

    private function createRouteList() : void {
        $this->route_list = ["index"=> new RouteIndex($this->ctrl_list["main"]),
                             "add-unit" => new RouteAddUnit($this->ctrl_list["unit"]),
                             "add-unit-origin" => new RouteAddOrigin($this->ctrl_list["unit"]),
                             "search" => new RouteSearch($this->ctrl_list["unit"]),
                             "er-404" => new RouteEr404($this->ctrl_list["error"])];
    }

    private function getParam(array $array, string $paramName, bool $canBeEmpty = true) : mixed {
        if (isset($array[$paramName])) {
            if(!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Paramètre '$paramName' vide");
            return $array[$paramName];
        } else {
            return $array["er-404"];
        }
    }

    public function routing($get=[], $post=[]) : void {
        if (isset($get[$this->action_key]) || isset($post[$this->action_key])) {
            if (!empty($post)) {
                $route = $this->getParam($this->route_list, $post[$this->action_key]);
                $route->action([], "POST");
            } else {
                $route = $this->getParam($this->route_list, $get[$this->action_key]);
                if ($get[$this->action_key] == "del-unit") { //delete à priori ...
                    $route = $this->route_list["index"];
                    $route->action(["del_unit" => true]);
                } elseif ($get[$this->action_key] == "edit-unit") { //edit-unit ou update ...
                    $route = $this->route_list["add-unit"];
                    $route->action(isset($get["id"]) ? $get["id"] : []);
                } else {
                    $route->action();
                }
            }
        } else {
            $this->route_list["index"]->action();
        }
    }

}

?>