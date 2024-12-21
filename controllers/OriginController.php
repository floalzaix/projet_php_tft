<?php 

namespace Controllers;

use League\Plates\Engine;
use Models\OriginDAO;
use Models\Origin;
use Helpers\MessageHandler;

class OriginController {
    private $templates;
    private $origin_dao;

    public function __construct() {
        $this->templates = new Engine("views", "php");
        $this->origin_dao = new OriginDAO();
    }
    
    public function displayAddUnitOrigin(array $params = []) : void {
        $origin = isset($params["id"]) ? $this->origin_dao->getById($params["id"]) : null;

        /**
         * Display the message on the home page
         */
        MessageHandler::setMessageToPage($params["message"] ?? "", "add_origin", $params["error"] ?? false);

        echo $this->templates->render("add-origin", ["origin" => $origin]);
    }

    /**
     * Summary of createOrigin
     * Makes the link between the model and the route to create unit
     * @param string $name
     * @param string $url_img
     * @return void
     */
    public function createOrigin(string $name, string $url_img) : void {
        $origin = new Origin($name, $url_img);
        $this->origin_dao->createOrigin($origin);
    }
}

?>