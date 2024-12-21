<?php 

namespace Controllers;

use League\PLates\Engine;
use Models\UnitDAO;
use Models\OriginDAO;

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
        echo $this->templates->render("search", ["message" => $params["message"] ?? "", "content" => $params["content"] ?? []]);
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