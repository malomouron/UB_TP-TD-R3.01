<?php
declare(strict_types = 1);

namespace Models;

class Origin {
    private ?string $id;
    private string $name;
    private string $url_img;

    // Constructeur
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    /**
     * @param string $url_img
     */
    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }


}

?>
