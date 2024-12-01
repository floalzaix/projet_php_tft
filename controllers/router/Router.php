<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteAddUnit;
use Controllers\Router\Route\RouteIndex;
use Controllers\UnitController;

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
                             "unit" => new UnitController()];
    }

    private function createRouteList() : void {
        $this->route_list = ["index"=> new RouteIndex($this->ctrl_list["main"]),
                             "add-unit" => new RouteAddUnit($this->ctrl_list["unit"])];
    }

    public function routing($get=[], $post=[]) : void {
        if (isset($get[$this->action_key]) || isset($post[$this->action_key])) {
            if (isset($post)) {
                $this->route_list[$get[$this->action_key]]->action("POST");
            } else {
                $this->route_list[$get[$this->action_key]]->action();
            } 
        } else {
            $this->route_list["index"]->action();
        }
    }
}

?>