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

    public function searchUnits(string $field) : array {
        $units = $this->unit_dao->searchInUnits($field);
        return $units;
    }

    public function searchOrigins(string $field) : array {
        $origins = $this->origin_dao->searchInOrigins($field);
        return $origins;
    }
}

?>