<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Unit;
use Models\UnitDAO;
use Models\OriginDAO;
use Helpers\MessageHandler;

class UnitController {
    private $templates;
    private $unit_dao;
    private $origins_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this->unit_dao = new UnitDAO();
        $this->origins_dao = new OriginDAO();
    }

    public function displayAddUnit($params = []) : void {
        $unit = $this->unit_dao->getById($params["id"] ?? null); //If accessed in edit mode gets the unit form the db to display its parameters.
        $origins = $this->origins_dao->getAll();

        /**
         * Display the message on the add_unit page
         */
        MessageHandler::setMessageToPage($params["message"] ?? "", "add_unit", $params["error"] ?? false);

        echo $this->templates->render("add-unit", ["unit" => $unit, "origins" => $origins]);
    }

    /**
     * Summary of addUnit
     * Makes the link between the model and the route to create a unit.
     * @param string $name
     * @param int $cost
     * @param array $origins
     * @param string $url_img
     * @return void
     */
    public function addUnit(string $name, int $cost, array $origins, string $url_img) : void {
        $new_unit = new Unit($name, $cost,  $url_img);
        $objects_origins = [];
        /**
         * The given parameter $origin is a list of strings. It musst be converted to a list of Origins before given to
         * the createUnit function because a unit is made of a list of Origin. 
        */
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