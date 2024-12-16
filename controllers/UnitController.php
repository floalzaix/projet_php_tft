<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Unit;
use Models\UnitDAO;
use Models\UnitOriginsDAO;

class UnitController {
    private $templates;
    private $unit_dao;
    private $unit_origins_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this-> unit_dao = new UnitDAO();
        $this->unit_origins_dao = new UnitOriginsDAO();
    }

    public function displayAddUnit(?string $message = "", ?string $id) : void {
        $unit = $this->unit_dao->getById($id);
        echo $this->templates->render("add-unit", ["message" => $message, "unit" => $unit]);
    }

    public function addUnit(string $name, int $cost, array $origins, string $url_img) : void {
        $new_unit = new Unit($name, $cost,  $url_img);
        $this->unit_origins_dao->addOriginsToUnit($new_unit->getId(), $origins);
        $this->unit_dao->createUnit($new_unit);
    }
}

?>