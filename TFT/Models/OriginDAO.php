<?php

declare(strict_types=1);

namespace Models;

use Exception;
use PDO;

/**
 * Classe OriginDAO pour gérer les interactions avec la base de données pour les origines.
 */
class OriginDAO extends BasePDODAO {

    /**
     * Récupère toutes les origines.
     *
     * @return array Liste des origines.
     * @throws Exception Si une erreur PDO survient.
     */
    public function getAll(): array {
        $origin = [];
        $query = "SELECT * FROM UB_TFT_ORIGIN";
        $stmt = $this->execRequest($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $origin[] = new Origin(["id" => $row['id'], "name" => $row['name'], "urlImg" => $row['url_img']]);
        }
        return $origin;
    }

    /**
     * Récupère une origine par son ID.
     *
     * @param string $idOrigin Identifiant de l'origine.
     * @return Origin|null L'origine correspondante ou null si non trouvée.
     * @throws Exception Si une erreur PDO survient.
     */
    public function getByID(string $idOrigin): ?Origin {
        $query = "SELECT * FROM UB_TFT_ORIGIN WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idOrigin]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Origin(["id" => $row['id'], "name" => $row['name'], "urlImg" => $row['url_img']]);
        }

        return null; // Retourne null si l'ID n'est pas trouvé
    }

    /**
     * Crée une nouvelle origine.
     *
     * @param Origin $origin L'origine à créer.
     * @return void
     * @throws Exception Si une erreur PDO survient.
     */
    public function createOrigin(Origin $origin): void {
        $query = "INSERT INTO UB_TFT_ORIGIN (name, url_img) VALUES (:name, :urlImg)";
        $this->execRequest($query, ['name' => $origin->getName(), 'urlImg' => $origin->getUrlImg()]);
    }

    /**
     * Supprime une origine par son ID.
     *
     * @param string $idOrigin Identifiant de l'origine à supprimer.
     * @return int Nombre de lignes affectées.
     * @throws Exception Si une erreur PDO survient.
     */
    public function deleteOrigin(string $idOrigin): int {
        $query = "DELETE FROM UB_TFT_ORIGIN WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idOrigin]);
        return $stmt->rowCount();
    }

    /**
     * Met à jour une origine existante.
     *
     * @param Origin $origin L'origine à mettre à jour.
     * @return void
     * @throws Exception Si une erreur PDO survient.
     */
    public function editOrigin(Origin $origin): void {
        $query = "UPDATE UB_TFT_ORIGIN SET name = :name, url_img = :urlImg WHERE id = :id";
        $this->execRequest($query, ['id' => $origin->getId(), 'name' => $origin->getName(), 'urlImg' => $origin->getUrlImg()]);
    }
}

