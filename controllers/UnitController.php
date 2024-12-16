<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Unit;
use Models\UnitDAO;
use Models\OriginDAO;

class UnitController {
    private $templates;
    private $unit_dao;
    private $origins_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this->unit_dao = new UnitDAO();
        $this->origins_dao = new OriginDAO();
    }

    public function displayAddUnit(?string $message = "", ?string $id) : void {
        $unit = $this->unit_dao->getById($id);
        $origins = $this->origins_dao->getAll();
        echo $this->templates->render("add-unit", ["message" => $message, "unit" => $unit, "origins" => $origins]);
    }

    public function addUnit(string $name, int $cost, array $origins, string $url_img) : void {
        $new_unit = new Unit($name, $cost,  $url_img);
        $objects_origins = [];
        foreach($origins as $origin) {
            if ($origin != "NULL") {
                $object_origin = $this->origins_dao->getById($origin);
                $objects_origins[] = $object_origin;
            }
        }
        $new_unit->setOrigins($objects_origins);
        $this->unit_dao->createUnit($new_unit);
    }
}

?>