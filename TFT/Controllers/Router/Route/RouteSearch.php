<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

/**
 * Classe RouteSearch pour gérer les routes de recherche.
 */
class RouteSearch extends Route
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
     * Méthode GET : appelle la méthode displaySearch() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function get(array $parametres = []): void
    {
        $this->controleur->displaySearch($parametres);
    }

    /**
     * Méthode POST : traite les données du formulaire et appelle la méthode displaySearch() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     * @throws Exception Si une erreur survient.
     */
    public function post(array $parametres = []): void
    {
        $parametres["search"] = parent::getParam($_POST, "name");
        $parametres["origin"] = parent::getParam($_POST, "origin");
        $this->controleur->displaySearch($parametres);
    }
}