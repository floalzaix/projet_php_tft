<?php

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;

class MainController {
    private $templates;
    private $unit_dao;

    function __construct() {
        $this->templates = new Engine("views", "php");
        $this->unit_dao = new UnitDAO();
    }
    public function index($del_unit=false) : void {
        $list_units = $this->unit_dao->getAll();
        $first = $this->unit_dao->getById("blabla");
        $other = $this->unit_dao->getById("blabla2");
        if ($del_unit) {
            echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble", "message" => "Etes vous sur de vouloir supprimer cette unité ?","list_units" => $list_units, "first" => $first, "other" => $other]);
        } else {
            echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble", "list_units" => $list_units, "first" => $first, "other" => $other]);
        }
    }

    public function displaySearch() : void {
        echo $this->templates->render("search");
    }
}

?>