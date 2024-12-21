<?php

namespace Controllers;

use League\Plates\Engine;
use Models\OriginDAO;
use Models\UnitDAO;
use Models\Unit;
use Models\Origin;
use Models\UnitOriginsDAO;

class MainController {
    private $templates;
    private $unit_dao;
    private $origin_dao;

    function __construct() {
        $this->templates = new Engine("views", "php");
        $this->unit_dao = new UnitDAO();
        $this->origin_dao = new OriginDAO();
    }

    /**
     * Summary of editUnit
     * Makes the link between the models and the routes to edit an unit.
     * @param string $name
     * @param int $cost
     * @param array $origins
     * @param string $url_img
     * @param string $id
     * @return void
     */
    public function editUnit(string $name, int $cost, array $origins, string $url_img, string $id) : void {
        $new_unit = new Unit($name, $cost, $url_img);
        $new_unit->setId($id);
        /**
         * The given parameter $origin is a list of strings. It musst be converted to a list of Origins before given to
         * the createUnit function because a unit is made of a list of Origin. 
        */
        $objects_origins = [];
        foreach($origins as $origin) {
            if ($origin != "NULL") {
                $object_origin = $this->origin_dao->getById($origin);
                $objects_origins[] = $object_origin;
            }
        }
        $new_unit->setOrigins($objects_origins);
        $this->unit_dao->createUnit($new_unit);
    }

    /**
     * Summary of delUnit
     * Link between model and route to delete unit
     * @param string $id
     * @return void
     */
    public function delUnit(string $id) : void {
        $this->unit_dao->deleteUnit($id);
    }

    /**
     * Summary of editOrigin
     * Link between the model and the route to edit an origin
     * @param string $name
     * @param string $url_img
     * @param string $id
     * @return void
     */
    public function editOrigin(string $name, string $url_img, string $id) : void {
        $origin = new Origin($name, $url_img);
        $origin->setId($id);
        $this->origin_dao->createOrigin($origin);
    }
    
    /**
     * Summary of delOrigin
     * Link between the model and the route to delete an origin.
     * @param string $id
     * @return void
     */
    public function delOrigin(string $id) : void {
        $this->origin_dao->deleteOrigin($id);
    }

    public function index($params = []) : void {
        $list_units = $this->unit_dao->getAll();
        $list_origins = $this->origin_dao->getAll();
        $message = $params["message"] ?? ""; //Message to be displayed on the page to delete a unit or an origin, or the other error/success messages
        if (isset($params["del_unit"]) && $params["del_unit"] == true && !isset($params["message"])) {
            $message= 
                "
                    <form action='index.php' method='POST'>
                        <input type='hidden' id='id' name='id' value=".($params['id'] ?? null)." />
                        <input type='hidden' id='del_unit' name='del_unit' value='true' />                  <!-- To access the home page in del mode -->
                        <p>Etes-vous sur de vouloir supprimer l'unité</p>
                        <input type='submit' id='submit_button' name='confirm_button' value='Confirmer' />
                        <input type='submit' id='submit_button' name='cancel_button' value='Annuler' />
                    </form> 
                ";
        }
        if (isset($params["del_origin"]) && $params["del_origin"] == true && !isset($params["message"])) {
            $message= 
                "
                    <form action='index.php' method='POST'>
                        <input type='hidden' id='id' name='id' value=".($params['id'] ?? null)." />
                        <input type='hidden' id='del_origin' name='del_origin' value='true' />              <!-- To access the home page in del mode -->
                        <p>Etes-vous sur de vouloir supprimer l'origine</p>
                        <input type='submit' id='submit_button' name='confirm_button' value='Confirmer' />
                        <input type='submit' id='submit_button' name='cancel_button' value='Annuler' />
                    </form> 
                ";
        }

        echo $this->templates->render("home", ["tft_set_name" => "Into the Arcane", "message" => $message, "list_units" => $list_units, "list_origins" => $list_origins]);
    }
}

?>