<?php
declare(strict_types=1);

namespace Models;

use Config\Config;
use Exception;
use Helpers\Logger;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Classe abstraite BasePDODAO pour gérer les interactions avec la base de données via PDO.
 */
abstract class BasePDODAO
{
    /**
     * @var PDO $db Instance de la connexion PDO.
     */
    private PDO $db;

    /**
     * @var Logger $logger Instance du logger.
     */
    private Logger $logger;

    /**
     * Constructeur : initialise la connexion à la base de données.
     * @throws Exception Si une erreur PDO se produit.
     */
    public function __construct()
    {
        $this->db = $this->getDB();
        $this->logger = new Logger("logs/".date('Y-m-d')."-tft.log");
    }

    /**
     * Exécute une requête SQL avec des paramètres optionnels.
     *
     * @param string $sql Requête SQL à exécuter.
     * @param array|null $params Paramètres de la requête.
     * @return PDOStatement Résultat de la requête.
     * @throws Exception Si une erreur PDO se produit.
     */
    protected function execRequest(string $sql, array $params = null): PDOStatement
    {
        if ($params !== null) {
            $this->logger->log("Requête SQL : $sql avec les paramètres " . json_encode($params));
        } else {
            $this->logger->log("Requête SQL : $sql");
        }
        try {
            $stmt = $this->getDB()->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
            if ($params === null) {
                $stmt->execute();
            } else {
                $stmt->execute($params);
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
        return $stmt;
    }

    /**
     * Récupère l'instance de la connexion PDO.
     *
     * @return PDO Instance de la connexion PDO.
     * @throws Exception Si une erreur PDO se produit.
     */
    private function getDB() : PDO
    {
        $this->db = new PDO(Config::get('dsn'), Config::get('user'), Config::get('pass'));
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->db;
    }
}