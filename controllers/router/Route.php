<?php

namespace Controllers\Router;

use Exception;

abstract class Route {
    public function action($params=[], $method="GET"): void {
        if ($method == "GET") {
            $this->get($params);
        } elseif ($method == "POST") {
            $this->post($params);
        } else {
            throw new Exception("Méthode {$method} non valide");
        }
    }

    public abstract function get($params =[]) : void;
    public abstract function post($params =[]) : void;
}

?>