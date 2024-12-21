<?php 

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\ErrorController;

class RouteEr404 extends Route {
    private ErrorController $controller;

    public function __construct($controller) {
        $this->controller = new ErrorController;
    }

    public function get($params = []) : void {
        $this->controller->displayError404(); //Display the 404 error page when the asked page does not exists 
    }
    public function post($params = []) : void {

    }
}

?>