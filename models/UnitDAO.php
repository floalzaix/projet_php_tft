<?php

namespace Models;

use Exception;

class UnitDAO extends BasePDODAO {
    public function getAll() : array {
        $units = array();
        $sql = "SELECT * FROM units";
        $query = $this->execRequest($sql);
        foreach ($query as $row) {
            $unit = new Unit($row["name"], $row["cost"], $row["origin"], $row["url_img"]);
            $units[] = $unit;
        }
        return $units;
    }
    public function getById(string $id) : ?Unit {
        $sql = "SELECT * FROM units WHERE id = :id";
        $query = $this->execRequest($sql, ["id" => $id]);
        if ($query != false) {
            if ($query->rowCount() > 1) {
                echo "Problème plusieurs unités avec le même id";
                return null;
            } elseif ($query->rowCount() == 1) {
                $row = $query->fetch();
                return new Unit($row["name"], $row["cost"], $row["origin"], $row["url_img"]);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function createUnit(Unit $unit) : void {
        $sql = "INSERT INTO units (id, name, cost, origin, url_img) VALUE (:id, :name, :cost, :origin, :url_img)";
        $query = $this->execRequest($sql, ["id" => $unit->getId(),
                                           "name" => $unit->getName(),
                                           "cost" => $unit->getCost(),
                                           "origin" => $unit->getOrigin(),
                                           "url_img" => $unit->getUrlImg()]);
        if ($query == false) {
            throw new Exception("Erreur lors de la création de l'unité dans la base de donnée");
        }
    }
}
