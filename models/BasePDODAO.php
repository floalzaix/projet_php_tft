<?php

namespace Models;

use PDO;
use Config\Config;
use PDOStatement;

class BasePDODAO {
    private PDO $db;
    private function getDB() : PDO {
        if (!isset($this->db)) {
            $this->db = new PDO(Config::get("dsn"), Config::get("user"), Config::get("pass"));
        }
        return $this->db;
    }

    protected function execRequest(string $sql, array $params = null) : bool|PDOStatement {
        $this->getDB();
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query; //Consigne bizarre sur le TP à verifier.
    }
}
