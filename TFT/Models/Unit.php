<?php
declare(strict_types = 1);

namespace Models;

/**
 * Classe Unit pour représenter une unité.
 */
class Unit {
    /**
     * @var string|null $id Identifiant de l'unité.
     */
    private ?string $id;

    /**
     * @var string $name Nom de l'unité.
     */
    private string $name;

    /**
     * @var int $cost Coût de l'unité.
     */
    private int $cost;

    /**
     * @var array $origin Origines de l'unité.
     */
    private array $origin;

    /**
     * @var string $url_img URL de l'image de l'unité.
     */
    private string $url_img;

    /**
     * Constructeur : initialise l'unité avec les données fournies.
     *
     * @param array $data Données pour initialiser l'unité.
     */
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    /**
     * Hydrate l'objet avec les données fournies.
     *
     * @param array $data Données pour hydrater l'objet.
     * @return void
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Récupère l'identifiant de l'unité.
     *
     * @return string|null Identifiant de l'unité.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Définit l'identifiant de l'unité.
     *
     * @param string|null $id Identifiant de l'unité.
     * @return void
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * Récupère le nom de l'unité.
     *
     * @return string Nom de l'unité.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Définit le nom de l'unité.
     *
     * @param string $name Nom de l'unité.
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Récupère le coût de l'unité.
     *
     * @return int Coût de l'unité.
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * Définit le coût de l'unité.
     *
     * @param int $cost Coût de l'unité.
     * @return void
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * Récupère les origines de l'unité.
     *
     * @return array Origines de l'unité.
     */
    public function getOrigin(): array
    {
        return $this->origin;
    }

    /**
     * Définit les origines de l'unité.
     *
     * @param array $origin Origines de l'unité.
     * @return void
     */
    public function setOrigin(array $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * Récupère l'URL de l'image de l'unité.
     *
     * @return string URL de l'image de l'unité.
     */
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    /**
     * Définit l'URL de l'image de l'unité.
     *
     * @param string $url_img URL de l'image de l'unité.
     * @return void
     */
    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }
}
