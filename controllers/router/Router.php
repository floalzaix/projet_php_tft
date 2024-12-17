<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteAddUnit;
use Controllers\Router\Route\RouteEr404;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddOrigin;
use Controllers\Router\Route\RouteSearch;
use Controllers\SearchController;
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
                            "origin" => new OriginController(),
                            "search" => new SearchController()];
    }

    private function createRouteList() : void {
        $this->route_list = ["index"=> new RouteIndex($this->ctrl_list["main"]),
                             "add-unit" => new RouteAddUnit($this->ctrl_list["unit"]),
                             "add-unit-origin" => new RouteAddOrigin($this->ctrl_list["origin"]),
                             "search" => new RouteSearch($this->ctrl_list["search"]),
                             "er-404" => new RouteEr404($this->ctrl_list["error"])];
    }

    /**
     * Summary of getRoute
     * -> Get the route given an array intended to be the routes list and returns the route designed by the string given by parameters.
     * @param array $array      //Routes 
     * @param string $paramName //Route asked
     * @return mixed            //If the route does not exists it returns a route leading to page error 404.
     */
    private function getRoute(array $array, string $paramName) : mixed {
        if (isset($array[$paramName])) {
            return $array[$paramName];
        } else {
            return $array["er-404"];
        }
    }

    public function routing($get=[], $post=[]) : void {
        //Testing the selected method. Basically if post is empty then its accessed with a get otherwise with a post.
        $method = "GET";
        if (!empty($post)) {
            $method = "POST";
        }

        //If there is the key action given in the URL get then it gets the route linked to it. Finaly it execute the action of the route.
        if (isset($get[$this->action_key])) {
            $route = $this->getRoute($this->route_list, $get[$this->action_key]); //Getting the route

            /**
             * Deals with the actions that are not intended to be routes. 
             * Basicaly, it sets the route the desired route and specifies the parameters in order to notify the route there is an action  to perform.
            */
            if ($get[$this->action_key] == "del-unit") {                                                        //Deleting a unit
                $route = $this->route_list["index"];
                $route->action(["del_unit" => true, "id" => $get["id"] ?? null], $method);
            } elseif ($get[$this->action_key] == "edit-unit") {                                                 //Editing a unit
                $route = $this->route_list["add-unit"];
                $route->action(["id" => $get["id"] ?? null], $method);
            } elseif ($get[$this->action_key] == "del-origin") {                                                //Deleting an origin
                $route = $this->route_list["index"];
                $route->action(["del_origin" => true, "id" => $get["id"] ?? null], $method);
            } elseif ($get[$this->action_key] == "edit-origin") {                                               //Editing an origin
                $route = $this->route_list["add-unit-origin"];
                $route->action(["id" => $get["id"] ?? null], $method);
            } else {                                                                                            //Otherwise execute the action of the route
                $route->action($post, $method);
            }
        } else {
            $this->route_list["index"]->action($post, $method);                                 //Index is the default choice if the action key is not define in $_GET
        }
    }

}

?>