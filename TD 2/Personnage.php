<?php

declare(strict_types=1);
class Personnage
{
    private int $id;
    private string $nom;
    private int $ForcePerso;
    private int $Degats;

    /**
     * @return mixed
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getForcePerso() : int
    {
        return $this->ForcePerso;
    }

    /**
     * @param mixed $ForcePerso
     */
    public function setForcePerso(int $ForcePerso)
    {
        $this->ForcePerso = $ForcePerso;
    }

    /**
     * @return mixed
     */
    public function getDegats() : int
    {
        return $this->Degats;
    }

    /**
     * @param mixed $Degats
     */
    public function setDegats(int $Degats)
    {
        $this->Degats = $Degats;
    }


    public function __construct(string $nom, int $ForcePerso, int $Degats)
    {
        $this->nom = $nom;
        $this->ForcePerso = $ForcePerso;
        $this->Degats = $Degats;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


    public function __ToString() : string
    {
        return $this->nom;
    }


}