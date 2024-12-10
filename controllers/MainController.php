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

    public function delUnit(string $id) : void {
        $this->unit_dao->deleteUnit($id);
    }

    public function index($del_unit=false, ?string $id = null, ?string $message = null) : void {
        $list_units = $this->unit_dao->getAll();
        if ($del_unit) {
            if (!isset($message)) {
                $message = "
                    <form action='index.php' method='POST'>
                        <input type='hidden' id='id' name='id' value='{$id}' />
                        <p>Etes-vous sur de vouloir supprimer l'unité</p>
                        <input type='submit' id='submit_button' name='confirm_button' value='Confirmer' />
                        <input type='submit' id='submit_button' name='cancel_button' value='Annuler' />
                    </form> 
                ";
            }
            echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble", "message" => $message, "list_units" => $list_units]);
        } else {
            echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble", "list_units" => $list_units]);
        }
    }

    public function displaySearch() : void {
        echo $this->templates->render("search");
    }
}

?>