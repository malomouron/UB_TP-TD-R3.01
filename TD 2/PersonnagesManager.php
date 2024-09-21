<?php
declare(strict_types=1);
class PersonnagesManager
{
    private PDO $_db; // Instance de PDO

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function add(Personnage $perso)
    {
        // Check if the personnage already exists
        $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
        $q->bindValue(':nom', $perso->getNom(), PDO::PARAM_STR);
        $q->execute();
        $exists = $q->fetchColumn();

        if ($exists == 0) {
            // If the personnage does not exist, add it
            $q = $this->_db->prepare('INSERT INTO personnages (nom, ForcePerso, Degats) VALUES (:nom, :ForcePerso, :Degats)');
            $q->bindValue(':nom', $perso->getNom(), PDO::PARAM_STR);
            $q->bindValue(':ForcePerso', $perso->getForcePerso(), PDO::PARAM_INT);
            $q->bindValue(':Degats', $perso->getDegats(), PDO::PARAM_INT);
            $q->execute();
        }
    }

    public function get(string $perso) : ?Personnage
    {
        $q = $this->_db->prepare('SELECT id, nom, ForcePerso, Degats FROM personnages WHERE nom = ?');
        $q->execute([$perso]);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        if ($donnees == false) {
            return null;
        }
        return new Personnage($donnees['nom'], $donnees['ForcePerso'], $donnees['Degats']);
    }

}