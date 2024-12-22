<?php

namespace Models;

use Models\UnitOriginsDAO;
use Exception;

class UnitDAO extends UnitOriginsDAO {
    public function getAll() : array {
        $units = array();
        $sql = "SELECT * FROM units";
        $query = $this->execRequest($sql);
        foreach ($query as $row) {
            $unit = new Unit($row["name"], $row["cost"], $row["url_img"]);
            $unit->setId($row["id"]);
            $origins = $this->getOriginsOfUnit($row["id"]);
            $unit->setOrigins($origins);
            $units[] = $unit;
        }
        return $units;
    }
    public function getById(?string $id) : ?Unit {
        $sql = "SELECT * FROM units WHERE id = :id";
        $query = $this->execRequest($sql, ["id" => $id]);
        if ($query != false) {
            if ($query->rowCount() > 1) {
                echo "Problème plusieurs unités avec le même id";
                return null;
            } elseif ($query->rowCount() == 1) {
                $row = $query->fetch();
                $unit = new Unit($row["name"], $row["cost"], $row["url_img"]);
                $unit->setId($row["id"]);
                $origins = $this->getOriginsOfUnit($row["id"]);
                $unit->setOrigins($origins);
                return $unit;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Summary of createUnit
     * Creates a unit in db. If the given id already exists then modify its properties.
     * @param \Models\Unit $unit
     * @throws \Exception
     * @return void
     */
    public function createUnit(Unit $unit) : void {
        $sql = "INSERT INTO units (id, name, cost, url_img) VALUES (:id, :name, :cost, :url_img)";
        if ($this->getById($unit->getId()) != null) { //Tests if the given id already exists in the db.
            $sql = "UPDATE units SET name=:name, cost=:cost, url_img=:url_img WHERE id=:id";
        }

        $query = $this->execRequest($sql, ["id" => $unit->getId(),
                                           "name" => $unit->getName(),
                                           "cost" => $unit->getCost(),
                                           "url_img" => $unit->getUrlImg()]);
        if ($query == false) {
            throw new Exception("Erreur lors de la création de l'unité dans la base de donnée");
        }

        $origins_ids = [];
        foreach($unit->getOrigins() as $origin) {
            $origins_ids[] = $origin->getId();
        }
        $this->setOriginsOfUnit($unit->getId(), $origins_ids);
    }

    public function deleteUnit(string $id) : void {
        $sql = "DELETE FROM units WHERE id = :id";
        $query = false;
        if ($this->getById($id) != null) {
            $query = $this->execRequest($sql, ["id" => $id]);
        }

        if ($query == false) {
            throw new Exception("Erreur lors de la supression de l'unité dans la base de donnée");
        }
    }

    public function searchInUnits(string $field) : array {
        $sql = "SELECT * FROM units WHERE name LIKE :field";
        $query = $this->execRequest($sql, ["field" => "%".$field."%"]);

        if ($query == false) {
            throw new Exception("Erreur lors de la recherche en BDD d'un field");
        }

        $units = [];
        foreach($query as $row) {
            $unit = new Unit($row["name"], $row["cost"], $row["url_img"]);
            $unit->setId($row["id"]);
            $origins = $this->getOriginsOfUnit($row["id"]);
            $unit->setOrigins($origins);

            $units[] = $unit;
        }

        return $units;
    }
}
