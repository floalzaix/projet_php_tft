<?php

namespace Controllers;

use League\Plates\Engine;

class UnitController {
    private $templates;

    public function __construct() {
        $this->templates = new Engine("views", "php");
    }

    public function displayAddUnit() : void {
        echo $this->templates->render("add-unit");
    }

    public function displayAddUnitOrigin() : void {
        echo $this->templates->render("add-origin");
    }
}

?>