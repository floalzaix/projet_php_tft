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

    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true) : mixed {
        if (isset($array[$paramName])) {
            if(!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Le paramètre ".$paramName." est vide");
            return $array[$paramName] ?? "";
        } else {
            throw new Exception("Le paramètre ".$paramName." n'est pas définit");
        }
    }

    public abstract function get($params =[]) : void;
    public abstract function post($params =[]) : void;
}

?>