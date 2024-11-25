<?php

namespace Models;

class UnitDAO extends BasePDODAO {
    public function getAll() : array {
        $units = array();
        $sql = "SELECT * FROM units";
        $query = $this->execRequest($sql);
        foreach ($query as $row) {
            $unit = new Unit($row["id"], $row["name"], $row["cost"], $row["origin"], $row["url_img"]);
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
                return new Unit($row["id"], $row["name"], $row["cost"], $row["origin"], $row["url_img"]);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
