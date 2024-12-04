<?php

declare(strict_types=1);

namespace Models;

use Exception;
use PDO;
use PDOStatement;

/**
 * Classe UnitDAO pour gérer les interactions avec la base de données pour les unités.
 */
class UnitDAO extends BasePDODAO {

    /**
     * Récupère toutes les unités.
     *
     * @return array Liste des unités.
     * @throws Exception Si une erreur PDO survient.
     */
    public function getAll(): array {
        $units = [];
        $query = "SELECT * FROM UB_TFT_UNIT";
        $stmt = $this->execRequest($query);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $units[] = new Unit([
                "id" => $row['id'],
                "name" => $row['name'],
                "cost" => (int) $row['cost'],
                "urlImg" => $row['url_img']
            ]);
        }

        return $units;
    }

    /**
     * Récupère une unité par son ID.
     *
     * @param string $idUnit Identifiant de l'unité.
     * @return Unit|null L'unité correspondante ou null si non trouvée.
     * @throws Exception Si une erreur PDO survient.
     */
    public function getByID(string $idUnit): ?Unit {
        $query = "SELECT * FROM UB_TFT_UNIT WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idUnit]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Unit([
                "id" => $row['id'],
                "name" => $row['name'],
                "cost" => (int) $row['cost'],
                "urlImg" => $row['url_img']
            ]);
        }

        return null; // Retourne null si l'ID n'est pas trouvé
    }

    /**
     * Crée une unité.
     *
     * @param Unit $unit L'unité à créer.
     * @return void
     * @throws Exception Si une erreur PDO survient.
     */
    public function createUnit(Unit $unit): void {
        $query = "INSERT INTO UB_TFT_UNIT (id, name, cost, url_img) VALUES (:id, :name, :cost, :urlImg)";
        $this->execRequest($query, [
            'id' => $unit->getId(),
            'name' => $unit->getName(),
            'cost' => $unit->getCost(),
            'urlImg' => $unit->getUrlImg()
        ]);
    }

    /**
     * Supprime une unité par son ID.
     *
     * @param string $idUnit Identifiant de l'unité à supprimer.
     * @return int Nombre de lignes affectées.
     * @throws Exception Si une erreur PDO survient.
     */
    public function deleteUnit(string $idUnit): int {
        $query = "DELETE FROM UB_TFT_UNIT WHERE id = :id";
        $stmt = $this->execRequest($query, ['id' => $idUnit]);
        return $stmt->rowCount();
    }

    /**
     * Met à jour une unité existante.
     *
     * @param Unit $unit L'unité à mettre à jour.
     * @return void
     * @throws Exception Si une erreur PDO survient.
     */
    public function editUnitAndIndex(Unit $unit): void {
        $query = "UPDATE UB_TFT_UNIT SET name = :name, cost = :cost, url_img = :urlImg WHERE id = :id";
        $this->execRequest($query, [
            'id' => $unit->getId(),
            'name' => $unit->getName(),
            'cost' => $unit->getCost(),
            'urlImg' => $unit->getUrlImg()
        ]);
    }

    /**
     * Récupère les origines pour une unité donnée.
     *
     * @param string $unitId Identifiant de l'unité.
     * @return array Liste des origines de l'unité.
     * @throws Exception Si une erreur PDO survient.
     */
    public function getOriginsForUnit(string $unitId): array {
        $query = "SELECT * FROM UB_TFT_ORIGIN JOIN UB_TFT_UNITORIGIN ON UB_TFT_ORIGIN.id = UB_TFT_UNITORIGIN.id_origin WHERE UB_TFT_UNITORIGIN.id_unit = :id";
        $stmt = $this->execRequest($query, ['id' => $unitId]);
        $origins = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $origins[] = new Origin([
                "id" => $row['id_origin'],
                "name" => $row['name'],
                "urlImg" => $row['url_img']
            ]);
        }
        return $origins;
    }

    /**
     * Ajoute une origine à une unité.
     *
     * @param string $getId Identifiant de l'unité.
     * @param string $origin Identifiant de l'origine.
     * @return void
     * @throws Exception Si une erreur PDO survient.
     */
    public function addOriginToUnit(string $getId, string $origin): void {
        $query = "INSERT INTO UB_TFT_UNITORIGIN (id_origin, id_unit) VALUES (:id_origin, :id_unit)";
        $this->execRequest($query, [
            'id_origin' => $origin,
            'id_unit' => $getId
        ]);
    }

    /**
     * Supprime les origines d'une unité.
     *
     * @param string|null $getId Identifiant de l'unité.
     * @return void
     * @throws Exception Si une erreur PDO survient.
     */
    public function deleteOriginForUnit(?string $getId): void {
        $query = "DELETE FROM UB_TFT_UNITORIGIN WHERE id_unit = :id_unit";
        $this->execRequest($query, ['id_unit' => $getId]);
    }

    /**
     * Recherche des unités par nom.
     *
     * @param string $name Nom de l'unité à rechercher.
     * @return array Liste des unités correspondantes.
     * @throws Exception Si une erreur PDO survient.
     */
    public function searchByName(string $name): array {
        $query = "SELECT * FROM UB_TFT_UNIT WHERE name LIKE :name";
        $stmt = $this->execRequest($query, ['name' => "%$name%"]);
        return $this->searchReturn($stmt);
    }

    /**
     * Recherche des unités par origine.
     *
     * @param string $origin Nom de l'origine à rechercher.
     * @return array Liste des unités correspondantes.
     * @throws Exception Si une erreur PDO survient.
     */
    public function searchByOrigin(string $origin): array {
        $query = "SELECT UB_TFT_UNIT.id, UB_TFT_UNIT.name, UB_TFT_UNIT.cost, UB_TFT_UNIT.url_img FROM UB_TFT_UNIT JOIN UB_TFT_UNITORIGIN ON UB_TFT_UNIT.id = UB_TFT_UNITORIGIN.id_unit JOIN UB_TFT_ORIGIN ON UB_TFT_UNITORIGIN.id_origin = UB_TFT_ORIGIN.id WHERE UB_TFT_ORIGIN.name LIKE :origin";
        $stmt = $this->execRequest($query, ['origin' => "%$origin%"]);
        return $this->searchReturn($stmt);
    }

    /**
     * Recherche des unités par coût.
     * @param PDOStatement $stmt Requête PDO.
     * @return array Liste des unités correspondantes.
     * @throws Exception Si une erreur PDO survient.
     */
    private function searchReturn(PDOStatement $stmt): array
    {
        $units = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $units[] = new Unit([
                "id" => $row['id'],
                "name" => $row['name'],
                "cost" => (int)$row['cost'],
                "urlImg" => $row['url_img'],
                "origin" => $this->getOriginsForUnit($row['id'])
            ]);
        }
        return $units;
    }


}

