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
use Controllers\OriginController;
use Exception;

class Router {
    private $route_list,  $ctrl_list;
    private String $action_key;

    public function __construct($name_of_action_key = "action") {
        $this->action_key = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList() : void {
        $this->ctrl_list = ["main" => new MainController(), 
                            "unit" => new UnitController(),
                            "error" => new ErrorController(),
                            "origin" => new OriginController()];
    }

    private function createRouteList() : void {
        $this->route_list = ["index"=> new RouteIndex($this->ctrl_list["main"]),
                             "add-unit" => new RouteAddUnit($this->ctrl_list["unit"]),
                             "add-unit-origin" => new RouteAddOrigin($this->ctrl_list["origin"]),
                             "search" => new RouteSearch($this->ctrl_list["unit"]),
                             "er-404" => new RouteEr404($this->ctrl_list["error"])];
    }

    private function getRoute(array $array, string $paramName, bool $canBeEmpty = true) : mixed {
        if (isset($array[$paramName])) {
            if(!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Paramètre '$paramName' vide");
            return $array[$paramName];
        } else {
            return $array["er-404"];
        }
    }

    public function routing($get=[], $post=[]) : void {
        $method = "GET";
        if (!empty($post)) {
            $method = "POST";
        }

        if (isset($get[$this->action_key])) {
            $route = $this->getRoute($this->route_list, $get[$this->action_key]);

            if ($get[$this->action_key] == "del-unit") { //delete à priori ...
                $route = $this->route_list["index"];
                $route->action(["del_unit" => true, "id" => $get["id"] ?? null], $method);
            } elseif ($get[$this->action_key] == "edit-unit") { //edit-unit ou update ...
                $route = $this->route_list["add-unit"];
                $route->action(["id" => $get["id"] ?? null], $method);
            } elseif ($get[$this->action_key] == "del-origin") {
                $route = $this->route_list["index"];
                $route->action(["del_origin" => true, "id" => $get["id"] ?? null], $method);
            } elseif ($get[$this->action_key] == "edit-origin") {
                $route = $this->route_list["add-unit-origin"];
                $route->action(["id" => $get["id"] ?? null], $method);
            } else {
                $route->action($post, $method);
            }
        } else {
            $this->route_list["index"]->action($post, $method);
        }
    }

}

?>