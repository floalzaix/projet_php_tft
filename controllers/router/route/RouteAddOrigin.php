<?php 

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\OriginController;
use Exception;

class RouteAddOrigin extends Route {
    private OriginController $controller;

    public function __construct($controller) {
        $this->controller = new OriginController;
    }

    public function get($params = []) : void {
        $this->controller->displayAddUnitOrigin($params);
    }
    public function post($params = []) : void {
        $message = "Origine crée avec succés !";
        try {
             $this->controller->createOrigin(
                parent::getParam($params, "name", false),
                parent::getParam($params, "url_img", false)
             );
        } catch (Exception $error) {
            $message = $error->getMessage();
        }
        $this->controller->displayAddUnitOrigin(["message" => $message]);
    }
}

?>