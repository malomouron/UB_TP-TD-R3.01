<?php

declare(strict_types=1);

namespace Models;
use PDO;

class UnitDAO extends BasePDODAO {

    // Méthode pour récupérer toutes les unités
    public function getAll(): array {
        $units = [];
        $query = "SELECT * FROM UB_TFT_UNIT";
        $stmt = $this->execRequest($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $units[] = new Unit(["id" => $row['id'], "name" => $row['name'], "cost" => (int) $row['cost'], "origin" => $row['origin'], "urlImg" => $row['url_img']]);
        }

        return $units;
    }

    // Méthode pour récupérer une unité par son ID
    public function getByID(string $idUnit): ?Unit {
        $query = "SELECT * FROM UB_TFT_UNIT WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idUnit]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Unit(["id" => $row['id'], "name" => $row['name'], "cost" => (int) $row['cost'], "origin" => $row['origin'], "urlImg" => $row['url_img']]);
        }

        return null; // Retourne null si l'ID n'est pas trouvé
    }

    // Méthode pour créer une unité
    public function createUnit(Unit $unit): void {
        $query = "INSERT INTO UB_TFT_UNIT (id, name, cost, origin, url_img) VALUES (:id, :name, :cost, :origin, :urlImg)";
        $this->execRequest($query, ['id' => $unit->getId(), 'name' => $unit->getName(), 'cost' => $unit->getCost(), 'origin' => $unit->getOrigin(), 'urlImg' => $unit->getUrlImg()]);
    }

    // Méthode pour supprimer une unité
    public function deleteUnit(string $idUnit): int {
        $query = "DELETE FROM UB_TFT_UNIT WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idUnit]);
        return $stmt->rowCount();
    }

    // Méthode pour mettre à jour une unité
    public function editUnitAndIndex(Unit $unit): void {
        $query = "UPDATE UB_TFT_UNIT SET name = :name, cost = :cost, origin = :origin, url_img = :urlImg WHERE id = :id";
        $this->execRequest($query, ['id' => $unit->getId(), 'name' => $unit->getName(), 'cost' => $unit->getCost(), 'origin' => $unit->getOrigin(), 'urlImg' => $unit->getUrlImg()]);
    }
}

?>