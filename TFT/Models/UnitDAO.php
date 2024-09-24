<?php

namespace Models;

use Models\BasePDODAO;
use Models\Unit;
use PDO;

class UnitDAO extends BasePDODAO {

    // Méthode pour récupérer toutes les unités
    public function getAll(): array {
        $units = [];
        $query = "SELECT * FROM UB_TFT_UNIT";
        $stmt = $this->execRequest($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $units[] = new Unit($row['id'], $row['name'], (int) $row['cost'], $row['origin'], $row['url_img']);
        }

        return $units;
    }

    // Méthode pour récupérer une unité par son ID
    public function getByID(string $idUnit): ?Unit {
        $query = "SELECT * FROM UB_TFT_UNIT WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idUnit]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Unit($row['id'], $row['name'], (int) $row['cost'], $row['origin'], $row['url_img']);
        }

        return null; // Retourne null si l'ID n'est pas trouvé
    }
}

?>