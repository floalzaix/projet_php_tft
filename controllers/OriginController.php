<?php 

namespace Controllers;

use League\Plates\Engine;
use Models\OriginDAO;
use Models\Origin;

class OriginController {
    private $templates;
    private $origin_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this->origin_dao = new OriginDAO();
    }
    
    public function displayAddUnitOrigin(array $params = []) : void {
        $origin = $this->origin_dao->getById($params["id"] ?? null);
        echo $this->templates->render("add-origin", ["message" => $params["message"] ?? "", "origin" => $origin]);
    }

    public function createOrigin(string $name, string $url_img) : void {
        $origin = new Origin($name, $url_img);
        $this->origin_dao->createOrigin($origin);
    }
}

?>