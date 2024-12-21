<?php 

namespace Controllers;

use League\PLates\Engine;
use Models\UnitDAO;
use Models\OriginDAO;
use Helpers\MessageHandler;

class SearchController {
    private $templates;
    private $unit_dao;
    private $origin_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this->unit_dao = new UnitDAO();
        $this->origin_dao = new OriginDAO();
    }

    public function displaySearch($params = []) : void {
        /**
         * Display the message on the home page
         */
        MessageHandler::setMessageToPage($params["message"] ?? "", "search", $params["error"] ?? false);
        
        echo $this->templates->render("search", ["content" => $params["content"] ?? []]);
    }

    /**
     * Summary of searchUnits
     * Accessed when the name field in the search list in the search page is selected. Makes the link between the model and the route to search
     * the data base.
     * @param string $field
     * @return array
     */
    public function searchUnits(string $field) : array {
        $units = $this->unit_dao->searchInUnits($field);
        return $units;
    }

    /**
     * Summary of searchOrigins
     * Accessed when the origin field in the search list in the search page is selected. Makes the link between the model and the route to search
     * the data base.
     * @param string $field
     * @return array
     */
    public function searchOrigins(string $field) : array {
        $origins = $this->origin_dao->searchInOrigins($field);
        return $origins;
    }
}

?>