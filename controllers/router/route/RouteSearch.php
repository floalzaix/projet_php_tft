<?php 

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\SearchController;
use Exception;

class RouteSearch extends Route {
    private SearchController $controller;

    public function __construct($controller) {
        $this->controller = new SearchController;
    }

    public function get($params = []) : void {
        $this->controller->displaySearch();
    }
    public function post($params = []) : void {
        //Searching
        $message = "";
        $error = false; //True if the process faces a failure
        $content = []; //The content (Origins or Units) to be displayed after the search
        try {
            $search_select = parent::getParam($params, "search_select", false);
            $search_field = parent::getParam($params, "search_field", false);
            
            if ($search_select == "name") {
                $content = $this->controller->searchUnits($search_field);
            } elseif ($search_select == "origins") {
                $content = $this->controller->searchOrigins($search_field);
            } else {
                throw new Exception("Il faut sélectionner le champ nom ou origine pour rechercher !");
            }
        } catch(Exception $error) {
            $message = $error->getMessage(); //Handles exceptions to be displayed on the screen
            $error = true;
        }
        $this->controller->displaySearch(["message" => $message, "error" => $error, "content" => $content]);
    }
}

?>