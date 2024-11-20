<?php

namespace Controllers;

use League\Plates\Engine;

class MainController {
    private $templates;

    function __construct() {
        $this->templates = new Engine("views", "php");
    }
    public function index() : void{
        echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble"]);
    }
}

?>