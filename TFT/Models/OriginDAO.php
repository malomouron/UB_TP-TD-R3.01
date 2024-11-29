<?php

declare(strict_types=1);

namespace Models;
use PDO;

class OriginDAO extends BasePDODAO {

    // Méthode pour récupérer toutes les origins
    public function getAll(): array {
        $origin = [];
        $query = "SELECT * FROM UB_TFT_ORIGIN";
        $stmt = $this->execRequest($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $origin[] = new Origin(["id" => $row['id'], "name" => $row['name'], "urlImg" => $row['url_img']]);
        }
        return $origin;
    }

    // Méthode pour récupérer une origin par son ID
    public function getByID(string $idOrigin): ?Origin {
        $query = "SELECT * FROM UB_TFT_ORIGIN WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idOrigin]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Origin(["id" => $row['id'], "name" => $row['name'], "urlImg" => $row['url_img']]);
        }

        return null; // Retourne null si l'ID n'est pas trouvé
    }

    // Méthode pour créer une origin
    public function createOrigin(Origin $origin): void {
        $query = "INSERT INTO UB_TFT_ORIGIN (name, url_img) VALUES (:name, :urlImg)";
        $this->execRequest($query, ['name' => $origin->getName(), 'urlImg' => $origin->getUrlImg()]);
    }

    // Méthode pour supprimer une origin
    public function deleteOrigin(string $idOrigin): int {
        $query = "DELETE FROM UB_TFT_ORIGIN WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idOrigin]);
        return $stmt->rowCount();
    }

    // Méthode pour mettre à jour une origin
    public function editOrigin(Origin $origin): void {
        $query = "UPDATE UB_TFT_ORIGIN SET name = :name, url_img = :urlImg WHERE id = :id";
        $this->execRequest($query, ['id' => $origin->getId(), 'name' => $origin->getName(), 'urlImg' => $origin->getUrlImg()]);
    }
}

?>