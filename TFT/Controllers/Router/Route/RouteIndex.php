<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;

/**
 * Classe RouteIndex pour gérer les routes de l'index.
 */
class RouteIndex extends Route
{
    /**
     * @var $controleur Contrôleur principal (MainController).
     */
    private $controleur;

    /**
     * Constructeur : initialise le contrôleur et appelle le constructeur de la classe parente.
     *
     * @param $controleur Contrôleur principal.
     */
    public function __construct($controleur)
    {
        parent::__construct();
        $this->controleur = $controleur;
    }

    /**
     * Méthode GET : appelle la méthode index() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function get(array $parametres = []): void
    {
        $this->controleur->index();
    }

    /**
     * Méthode POST : pour l'instant, ne fait rien.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function post(array $parametres = []): void
    {
        $this->controleur->index();
    }
}