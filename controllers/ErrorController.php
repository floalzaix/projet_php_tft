<?php

namespace Controllers;

use League\Plates\Engine;

class ErrorController {
    private $templates;

    public function __construct() {
        $this->templates = new Engine("views", "php");
    }

    public function displayError404() : void  {
        echo $this->templates->render("er404");
    }
}

?>