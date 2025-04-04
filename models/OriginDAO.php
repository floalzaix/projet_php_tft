<?php

namespace Models;

use Models\BasePDODAO;
use Models\Origin;
use Exception;

class OriginDAO extends BasePDODAO {
    public function getAll() : array {
        $origins = [];

        $sql = "SELECT * FROM origins";
        $query = $this->execRequest($sql);

        if ($query == false) {
            throw new Exception("Erreur lors de la récupération de toutes les origines dans la base de donnée");
        }

        foreach($query as $row) {
            $origin = new Origin($row["name"], $row["url_img"]);
            $origin->setId($row["id"]);

            $origins[] = $origin;
        }

        return $origins;
    }

    public function getById(string $id) : ?Origin {
        $sql = "SELECT * FROM origins WHERE id=:id";
        $query = $this->execRequest($sql, ["id" => $id]);

        if ($query == false) {
            throw new Exception("Erreur lors de la récupération d'une origine dans la base de donnée");
        } elseif ($query->rowCount() > 1) {
            throw new Exception("Il y a plus d'une origin ayant le même id dans la base de donnée");
        } elseif ($query->rowCount() == 0) {
            return null;
        }
        
        $row = $query->fetch();
        $origin = new Origin($row["name"], $row["url_img"]);
        $origin->setId($row["id"]);

        return $origin;
    }

    /**
     * Summary of createOrigin
     * Create an origin in db. If the given id already exists then modify its properties in the db.
     * @param \Models\Origin $origin
     * @throws \Exception
     * @return void
     */
    public function createOrigin(Origin $origin) : void {
        $sql = "INSERT INTO origins(id, name, url_img) VALUE (:id, :name, :url_img)";
        
        if ($this->getById($origin->getId()) != null) { //Tests if the given id already exists
            $sql = "UPDATE origins SET name=:name, url_img=:url_img WHERE id=:id";
        }

        $query = $this->execRequest($sql, ["id" => $origin->getId(), "name" => $origin->getName(), "url_img" => $origin->getUrlImg()]);

        if ($query == false) {
            throw new Exception("Erreur lors de la création d'une origine en base de donnée !");
        }
    }

    public function deleteOrigin(string $id) : void {
        $sql = "DELETE FROM origins WHERE id=:id";
        $query = $this->execRequest($sql, ["id" => $id]);

        if ($query == false) {
            throw new Exception("Erreur lors de la supression d'une origine en base de donnée !");
        }
    }

    public function searchInOrigins(string $field) : array {
        $origins = [];

        $sql = "SELECT * FROM origins WHERE name LIKE :field";
        $query = $this->execRequest($sql, ["field" => "%".$field."%"]);

        if ($query == false) {
            throw new Exception("Erreur lors de la recherche en BDD des origines sur la base d'un field");
        }

        foreach($query as $row) {
            $origin = new Origin($row["name"], $row["url_img"]);
            $origin->setId($row["id"]);

            $origins[] = $origin;
        }

        return $origins;
    }
}

?>