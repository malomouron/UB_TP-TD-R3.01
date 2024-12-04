<?php
declare(strict_types = 1);

namespace Models;

/**
 * Classe Origin pour représenter une origine.
 */
class Origin {
    /**
     * @var string|null $id Identifiant de l'origine.
     */
    private ?string $id;

    /**
     * @var string $name Nom de l'origine.
     */
    private string $name;

    /**
     * @var string $url_img URL de l'image de l'origine.
     */
    private string $url_img;

    /**
     * Constructeur : initialise l'origine avec les données fournies.
     *
     * @param array $data Données pour initialiser l'origine.
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
     * Récupère l'identifiant de l'origine.
     *
     * @return string|null Identifiant de l'origine.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Définit l'identifiant de l'origine.
     *
     * @param string|null $id Identifiant de l'origine.
     * @return void
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * Récupère le nom de l'origine.
     *
     * @return string Nom de l'origine.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Définit le nom de l'origine.
     *
     * @param string $name Nom de l'origine.
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Récupère l'URL de l'image de l'origine.
     *
     * @return string URL de l'image de l'origine.
     */
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    /**
     * Définit l'URL de l'image de l'origine.
     *
     * @param string $url_img URL de l'image de l'origine.
     * @return void
     */
    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }
}
