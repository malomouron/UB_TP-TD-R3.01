<?php

declare(strict_types=1);

/**
 * Classe PersonnageManager
 *
 * Cette classe gère les opérations CRUD pour les objets Personnage dans la base de données.
 */
class PersonnageManager
{
    /**
     * Nom de la table dans la base de données.
     */
    private const TABLE_NAME = 'ub_personnages';

    /**
     * Instance de PDO pour la connexion à la base de données.
     */
    private $_db;

    /**
     * Constructeur
     *
     * @param PDO $db Instance de PDO pour la connexion à la base de données
     */
    public function __construct(PDO $db)
    {
        $this->_db = $db;
    }

    /**
     * Ajoute un personnage dans la base de données
     *
     * @param Personnage $perso Instance de Personnage à ajouter
     * @return void
     */
    public function add(Personnage $perso) : void
    {
        $q = $this->_db->prepare('INSERT INTO '.self::TABLE_NAME.'(nom, dateDerniereConnexion) VALUES(:nom, :dateDerniereConnexion)');
        $q->bindValue(':nom', $perso->getNom(), PDO::PARAM_STR);
        $q->bindValue(':dateDerniereConnexion', (new DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        echo  $q->execute();

        $perso->hydrate([
            'id' => $this->_db->lastInsertId(),
            'degats' => 0,
            'experience' => 0,
            'CoupsPortes' => 0,
            'DateDernierCoup' => null,
            'DateDerniereConnexion' => new DateTime(),
        ]);
    }

    /**
     * Compte le nombre de personnages dans la base de données
     *
     * @return int Le nombre de personnages
     */
    public function count() : int
    {
        return (int) $this->_db->query('SELECT COUNT(*) FROM '.self::TABLE_NAME)->fetchColumn();
    }

    /**
     * Supprime un personnage de la base de données
     *
     * @param Personnage $perso Instance de Personnage à supprimer
     * @return void
     */
    public function delete(Personnage $perso) : void
    {
        $this->_db->exec('DELETE FROM '.self::TABLE_NAME.' WHERE id = '.$perso->getId());
    }

    /**
     * Vérifie si un personnage existe dans la base de données
     *
     * @param string $info Nom ou ID du personnage
     * @return bool True si le personnage existe, False sinon
     */
    public function exists(string $info) : bool
    {
        if (is_int($info)) {
            $q = $this->_db->prepare('SELECT COUNT(*) FROM '.self::TABLE_NAME.' WHERE id = :id');
            $q->bindValue(':id', $info, PDO::PARAM_INT);
        } else {
            $q = $this->_db->prepare('SELECT COUNT(*) FROM '.self::TABLE_NAME.' WHERE nom = :nom');
            $q->bindValue(':nom', $info, PDO::PARAM_STR);
        }

        $q->execute();
        return (bool) $q->fetchColumn();
    }

    /**
     * Récupère un personnage de la base de données
     *
     * @param mixed $info Nom ou ID du personnage
     * @return Personnage Instance de Personnage récupérée
     */
    public function get($info) : Personnage
    {
        if (is_int($info)) {
            $q = $this->_db->query('SELECT id, nom, degats, experience, coupsPortes, dateDernierCoup, dateDerniereConnexion FROM '.self::TABLE_NAME.' WHERE id = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new Personnage($donnees);
        } else {
            $q = $this->_db->prepare('SELECT id, nom, degats, experience, coupsPortes , dateDernierCoup, dateDerniereConnexion FROM '.self::TABLE_NAME.' WHERE nom = :nom');
            $q->bindValue(':nom', $info, PDO::PARAM_STR);
            $q->execute();
            return new Personnage($q->fetch(PDO::FETCH_ASSOC));
        }
    }

    /**
     * Récupère la liste des personnages de la base de données
     *
     * @return array Tableau d'instances de Personnage
     */
    public function getList() : array
    {
        $persos = [];
        $q = $this->_db->query('SELECT id, nom, degats, experience, coupsPortes, dateDernierCoup, dateDerniereConnexion FROM '.self::TABLE_NAME.' ORDER BY nom');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Personnage($donnees);
        }
        return $persos;
    }

    /**
     * Met à jour un personnage dans la base de données
     *
     * @param Personnage $perso Instance de Personnage à mettre à jour
     * @return void
     */
    public function update(Personnage $perso): void
    {
        $q = $this->_db->prepare('UPDATE '.self::TABLE_NAME.' SET degats = :degats, nom = :nom, experience = :experience, coupsPortes = :coupsPortes, dateDernierCoup = :dateDernierCoup, dateDerniereConnexion = :dateDerniereConnexion WHERE id = :id');

        $boundParams = [
            ':degats' => $perso->getDegats(),
            ':nom' => $perso->getNom(),
            ':experience' => $perso->getExperience(),
            ':coupsPortes' => $perso->getCoupsPortes(),
            ':dateDernierCoup' => $perso->getDateDernierCoup() && $perso->getDateDernierCoup() !== '' ? $perso->getDateDernierCoup()->format('Y-m-d H:i:s') : null,
            ':dateDerniereConnexion' => $perso->getDateDerniereConnexion()->format('Y-m-d H:i:s'),
            ':id' => $perso->getId()
        ];

        foreach ($boundParams as $param => $value) {
            $q->bindValue($param, $value, is_int($value) ? PDO::PARAM_INT : (is_null($value) ? PDO::PARAM_NULL : PDO::PARAM_STR));
        }

        $q->execute();

    }

}