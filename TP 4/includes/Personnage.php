<?php
declare(strict_types=1);

class Personnage
{
    /**
     * Constante indiquant que le personnage a essayé de se frapper lui-même.
     */
    public const CEST_MOI = 1;

    /**
     * Constante indiquant que le personnage a été tué.
     */
    public const PERSONNAGE_TUE = 2;

    /**
     * Constante indiquant que le personnage a été frappé.
     */
    public const PERSONNAGE_FRAPPE = 3;

    /**
     * Constante indiquant que le nombre maximum de coups a été atteint.
     */
    public const COUPS_MAX = 4;

    /**
     * Constante indiquant que la connexion du personnage est réussie.
     */
    public const PERSONNAGE_CONNEXION_OK = 5;

    /**
     * Constante indiquant une nouvelle journée de connexion pour le personnage.
     */
    public const PERSONNAGE_CONNEXION_NEW_DAY = 6;

    /**
     * Points de vie maximum du personnage.
     */
    private const PV_MAX = 100;

    /**
     * Dégâts minimum infligés par le personnage.
     */
    private const DEGATS_MIN = 5;

    /**
     * Dégâts maximum infligés par le personnage.
     */
    private const DEGATS_MAX = 25;

    /**
     * Identifiant unique du personnage.
     */
    private int $id;

    /**
     * Nom du personnage.
     */
    private string $nom;

    /**
     * Dégâts subis par le personnage.
     */
    private int $degats;

    /**
     * Expérience accumulée par le personnage.
     */
    private int $experience;

    /**
     * Nombre de coups portés par le personnage.
     */
    private int $coupsPortes;

    /**
     * Date du dernier coup porté par le personnage.
     */
    private ?DateTime $dateDernierCoup;

    /**
     * Date de la dernière connexion du personnage.
     */
    private ?DateTime $dateDerniereConnexion;

    /**
     * Retourne l'identifiant du personnage.
     */
    public function getId(): int { return $this->id; }

    /**
     * Définit l'identifiant du personnage.
     */
    public function setId(int $id): void { $this->id = $id; }

    /**
     * Retourne le nom du personnage.
     */
    public function getNom(): string { return $this->nom; }

    /**
     * Définit le nom du personnage.
     */
    public function setNom(string $nom): void { $this->nom = $nom; }

    /**
     * Retourne les dégâts subis par le personnage.
     */
    public function getDegats(): int { return $this->degats; }

    /**
     * Définit les dégâts subis par le personnage.
     */
    public function setDegats(int $degats): void { $this->degats = $degats; }

    /**
     * Retourne le niveau du personnage basé sur son expérience.
     */
    public function getNiveau(): int { return intdiv($this->experience, 100 )+1; }

    /**
     * Retourne l'expérience accumulée par le personnage.
     */
    public function getExperience(): int { return $this->experience; }

    /**
     * Définit l'expérience accumulée par le personnage.
     */
    public function setExperience(int $experience): void { $this->experience = $experience; }

    /**
     * Retourne la force du personnage basée sur son niveau et son expérience.
     */
    public function getForce(): int { return (int) ($this->getNiveau() /100 * $this->experience); }

    /**
     * Retourne le nombre de coups portés par le personnage.
     */
    public function getCoupsPortes(): int { return $this->coupsPortes; }

    /**
     * Définit le nombre de coups portés par le personnage.
     */
    public function setCoupsPortes(int $coups_portes): void { $this->coupsPortes = $coups_portes; }

    /**
     * Retourne la date du dernier coup porté par le personnage.
     */
    public function getDateDernierCoup(): ?DateTime { return $this->dateDernierCoup; }

    /**
     * Définit la date du dernier coup porté par le personnage.
     */
    public function setDateDernierCoup(?DateTime $date_dernier_coup): void { $this->dateDernierCoup = $date_dernier_coup; }

    /**
     * Retourne la date de la dernière connexion du personnage.
     */
    public function getDateDerniereConnexion(): ?DateTime { return $this->dateDerniereConnexion; }

    /**
     * Définit la date de la dernière connexion du personnage.
     */
    public function setDateDerniereConnexion(?DateTime $date_derniere_connexion): void { $this->dateDerniereConnexion = $date_derniere_connexion; }

    /**
     * Frappe un autre personnage et retourne le résultat de l'action.
     */
    public function frapper(Personnage $personnage): int
    {
        if ($personnage->getId() == $this->id) {
            return self::CEST_MOI;
        }
        if ($this->coupsPortes >= 3 && $this->dateDernierCoup->format('Y-m-d') == (new DateTime())->format('Y-m-d')) {
            return self::COUPS_MAX; // Ou une autre constante indiquant que la limite est atteinte
        }
        $this->coupsPortes++;
        $this->dateDernierCoup = new DateTime();
        return $personnage->recevoirDegats($this->getForce());
    }

    /**
     * Reçoit des dégâts et retourne le résultat de l'action.
     */
    public function recevoirDegats(int $force): int
    {
        $degat = rand(self::DEGATS_MIN, self::DEGATS_MAX) + $force;
        $this->degats += $degat;
        return $this->isDead() ? self::PERSONNAGE_TUE : self::PERSONNAGE_FRAPPE;
    }

    /**
     * Vérifie si le personnage est mort.
     */
    public function isDead() : bool
    {
        return $this->degats >= self::PV_MAX;
    }

    /**
     * Vérifie la connexion du personnage et retourne le résultat de l'action.
     */
    public function checkConnexion(): int
    {
        $now = new DateTime();
        if ($this->dateDerniereConnexion->diff($now)->days > 0) {
            return self::PERSONNAGE_CONNEXION_NEW_DAY;
        } elseif ($this->dateDerniereConnexion->diff($now)->days == 0) {
            $this->degats += 10;
            $this->dateDerniereConnexion = $now;
        }
        return $this->isDead() ? self::PERSONNAGE_TUE : self::PERSONNAGE_CONNEXION_OK;
    }

    /**
     * Hydrate l'objet avec les données fournies.
     */
    public function hydrate(array $donnees): void
    {
        foreach ($donnees as $key => $value) {
            if (is_string($key)) {
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method)) {
                    if ($key === 'id' || $key === 'degats'  || $key === 'experience' || $key === 'coupsPortes') {
                        $value = intval( $value);
                    } elseif ($key === 'dateDernierCoup' || $key === 'dateDerniereConnexion') {
                        if ($value === null) {
                            $value = null;
                        } else {
                            $value = new DateTime();
                        }
                    }
                    $this->$method($value);
                }
            }
        }
    }

    /**
     * Retourne une chaîne de caractères représentant le personnage.
     */
    public function __toString() : string
    {
        return "Je suis le personnage ".$this->nom." et j'ai ".$this->degats." points de vie et ".$this->experience." points d'expérience et "  ." coups portés et ".$this->getForce()." points de force et "." date dernier coup et "." date dernière connexion ";
    }

    /**
     * Constructeur de la classe Personnage.
     */
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
}