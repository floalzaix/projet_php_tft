<?php

namespace Models;

use Models\BasePDODAO;
use Models\Origin;
use Exception;

class UnitOriginsDAO extends BasePDODAO {
    /**
     * Summary of getOriginsOfUnit
     * Gets the origin linked to a unit in the units_origins table.
     * @param string $id_unit
     * @throws \Exception
     * @return array
     */
    protected function getOriginsOfUnit(string $id_unit) : array {
        $sql = "SELECT * FROM units_origins uo INNER JOIN origins o ON o.id = uo.id_origin WHERE id_unit=:id_unit";
        $query = $this->execRequest($sql, ["id_unit" => $id_unit]);

        if ($query == false) {
            throw new Exception("Erreur lors de la récupération des origines d'une unité en base de donnée");
        } elseif ($query->rowCount() > 3) {
            throw new Exception("Une unité a trop d'origines associées !");
        } elseif ($query->rowCount() <= 0) {
            return [];
        }

        $origins = [];

        foreach($query as $row) {
            $origin = new Origin($row["name"], $row["url_img"]);
            $origin->setId($row["id_origin"]);

            $origins[] = $origin;
        }

        return $origins;
    }

    /**
     * Summary of setOriginsOfUnit
     * Delete all the origins linked to a unit and create new rows for the new ones. Tests if there is more than 3 origins.
     * @param string $id_unit
     * @param array $origins_ids
     * @throws \Exception
     * @return void
     */
    protected function setOriginsOfUnit(string $id_unit, array $origins_ids) : void {
        $sql = "DELETE FROM units_origins WHERE id_unit=:id_unit";
        $query = $this->execRequest($sql, ["id_unit" => $id_unit]);

        if ($query == false) {
            throw new Exception("Erreur lors de la supression des anciennes origines d'une unité !");
        }
        
        if (count($origins_ids) > 3) {
            throw new Exception("Il n'est pas possible d'ajouter plus de 3 origines à une unité.");
        }
        $sql = "INSERT INTO units_origins(id_unit, id_origin) VALUE (:id_unit, :id_origin)";
        foreach ($origins_ids as $id_origin) {
            $query = $this->execRequest($sql, ["id_unit" => $id_unit, "id_origin" => $id_origin]);
            if ($query == false) {
               throw new Exception("Erreur lors de l'association d'origines à une unité !");
            }
        }
    }
}

?>