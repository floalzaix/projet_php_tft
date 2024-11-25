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
    public function index() : void{
        $list_units = $this->unit_dao->getAll();
        $first = $this->unit_dao->getById("blabla");
        $other = $this->unit_dao->getById("blabla2");
        echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble", "list_units" => $list_units, "first" => $first, "other" => $other]);
    }
}

?>