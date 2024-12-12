<?php

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;
use Models\Unit;

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

    public function editUnit(string $name, int $cost, string $origin, string $url_img, ?string $id = null) : void {
        $new_unit = new Unit($name, $cost, $origin, $url_img);
        if (isset($id)) {
            $new_unit->setId($id);
        }
        $this->unit_dao->createUnit($new_unit);
    }

    public function index($params = []) : void {
        $list_units = $this->unit_dao->getAll();
        $message = $params["message"] ?? "";
        if (isset($params["del_unit"]) && $params["del_unit"] == true && !isset($params["message"])) {
            $message= 
                "
                    <form action='index.php' method='POST'>
                        <input type='hidden' id='id' name='id' value=".($params['id'] ?? null)." />
                        <p>Etes-vous sur de vouloir supprimer l'unité</p>
                        <input type='submit' id='submit_button' name='confirm_button' value='Confirmer' />
                        <input type='submit' id='submit_button' name='cancel_button' value='Annuler' />
                    </form> 
                ";
        }

        echo $this->templates->render("home", ["tft_set_name" => "Remix Rumble", "message" => $message, "list_units" => $list_units]);
    }

    public function displaySearch() : void {
        echo $this->templates->render("search");
    }
}

?>