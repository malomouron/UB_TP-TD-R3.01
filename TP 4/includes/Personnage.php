<?php
declare(strict_types=1);

class Personnage
{
    public const CEST_MOI = 1;
    public const PERSONNAGE_TUE = 2;
    public const PERSONNAGE_FRAPPE = 3;
    public const COUPS_MAX = 4;
    public const PERSONNAGE_CONNEXION_OK = 5;
    public const PERSONNAGE_CONNEXION_NEW_DAY = 6;
    private const PV_MAX = 100;
    private const DEGATS_MIN = 5;
    private const DEGATS_MAX = 25;

    private int $id;
    private string $nom;
    private int $degats;
    private int $experience;
    private int $coups_portes;
    private ?DateTime $date_dernier_coup;
    private ?DateTime $date_derniere_connexion;

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getNom(): string { return $this->nom; }

    public function setNom(string $nom): void { $this->nom = $nom; }

    public function getDegats(): int { return $this->degats; }

    public function setDegats(int $degats): void { $this->degats = $degats; }

    public function getNiveau(): int { return intdiv($this->experience, 100 )+1; }

    public function getExperience(): int { return $this->experience; }
    public function setExperience(int $experience): void { $this->experience = $experience; }

    public function getForce(): int { return (int) ($this->getNiveau() /100 * $this->experience); }

    public function getCoupsPortes(): int { return $this->coups_portes; }
    public function setCoupsPortes(int $coups_portes): void { $this->coups_portes = $coups_portes; }

    public function getDateDernierCoup(): ?DateTime { return $this->date_dernier_coup; }
    public function setDateDernierCoup(?DateTime $date_dernier_coup): void { $this->date_dernier_coup = $date_dernier_coup; }

    public function getDateDerniereConnexion(): ?DateTime { return $this->date_derniere_connexion; }
    public function setDateDerniereConnexion(?DateTime $date_derniere_connexion): void { $this->date_derniere_connexion = $date_derniere_connexion; }

    // Existing methods...

    public function frapper(Personnage $personnage): int
    {
        if ($personnage->getId() == $this->id) {
            return self::CEST_MOI;
        }
        if ($this->coups_portes >= 3 && $this->date_dernier_coup->format('Y-m-d') == (new DateTime())->format('Y-m-d')) {
            return self::COUPS_MAX; // Or some other constant indicating limit reached
        }
        $this->coups_portes++;
        $this->date_dernier_coup = new DateTime();
        return $personnage->recevoirDegats($this->getForce());
    }

    public function recevoirDegats(int $force): int
    {
        $degat = rand(self::DEGATS_MIN, self::DEGATS_MAX) + $force;
        $this->degats += $degat;
        return $this->isDead() ? self::PERSONNAGE_TUE : self::PERSONNAGE_FRAPPE;
    }

    public function isDead() : bool
    {
        return $this->degats >= self::PV_MAX;
    }

    public function checkConnexion(): int
    {
        $now = new DateTime();
        if ($this->date_derniere_connexion->diff($now)->days > 0) {
            return self::PERSONNAGE_CONNEXION_NEW_DAY;
        }elseif ($this->date_derniere_connexion->diff($now)->days == 0) {
            $this->degats += 10;

            $this->date_derniere_connexion = $now;
        }
        return $this->isDead() ? self::PERSONNAGE_TUE : self::PERSONNAGE_CONNEXION_OK;
    }

    public function hydrate(array $donnees): void
    {
        foreach ($donnees as $key => $value) {
            if (is_string($key)) {
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method)) {
                    if ($key === 'id' || $key === 'degats'  || $key === 'experience' || $key === 'CoupsPortes') {
                        $value = (int) $value;
                    } elseif ($key === 'DateDernierCoup' || $key === 'DateDerniereConnexion') {
                        $value = $value === null ? null : new DateTime($value);
                    }
                    $this->$method($value);
                }
            }
        }
    }

    public function __toString() : string
    {
        return "Je suis le personnage ".$this->nom." et j'ai ".$this->degats." points de vie et ".$this->experience." points d'expérience et "  ." coups portés et ".$this->getForce()." points de force et "." date dernier coup et "." date dernière connexion ";
    }

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
}