<?php

namespace Models;

class UnitDAO extends BasePDODAO {
    public function getUnits() : array {
        $units = array();
        $sql = "SELECT * FROM unit";
        $query = $this->execRequest($sql);
        foreach ($query as $row) {
            $unit = new Unit($row["id"], $row["name"], $row["cost"], $row["origin"], $row["url_img"]);
            $units[] = $unit;
        }
        return $units;
    }
    public function getById(string $id) : ?Unit {
        $sql = "SELECT * FROM unit WHERE id = :id";
        $query = $this->execRequest($sql, ["id" => $id]);
        if ($query->rowCount() > 1) {
            echo "Problème plusieurs unités avec le même id";
            return null;
        } elseif ($query->rowCount() == 1) {
            $row = $query->fetch();
            return new Unit($row["id"], $row["name"], $row["cost"], $row["origin"], $row["url_img"]);
        } else {
            return null;
        }
    }
}
