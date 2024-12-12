<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Unit;
use Models\UnitDAO;

class UnitController {
    private $templates;
    private $unit_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this-> unit_dao = new UnitDAO();
    }

    public function displayAddUnit(?string $message = "", ?string $id) : void {
        $unit = $this->unit_dao->getById($id);
        echo $this->templates->render("add-unit", ["message" => $message, "unit" => $unit]);
    }

    public function addUnit(string $name, int $cost, string $origin, string $url_img) : void {
        $new_unit = new Unit($name, $cost, $origin, $url_img);
        $this->unit_dao->createUnit($new_unit);
    }

    public function displayAddUnitOrigin() : void {
        echo $this->templates->render("add-origin");
    }
}

?>