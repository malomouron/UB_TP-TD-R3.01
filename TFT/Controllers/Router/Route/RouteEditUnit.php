<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

/**
 * Classe RouteEditUnit pour gérer les routes d'édition d'unité.
 */
class RouteEditUnit extends Route
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
     * Méthode GET : appelle la méthode displayAddUnit() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function get(array $parametres = []): void
    {
        $this->controleur->displayAddUnit($parametres);
    }

    /**
     * Méthode POST : traite les données du formulaire et appelle la méthode displayAddUnit() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     * @throws Exception Si une erreur survient.
     */
    public function post(array $parametres = []): void
    {
        $parametres["name"] = parent::getParam($_POST, "name", false);
        $parametres["origin"] = [
            parent::getParam($_POST, "origin1"),
            parent::getParam($_POST, "origin2"),
            parent::getParam($_POST, "origin3")
        ];
        $parametres["cost"] = parent::getParam($_POST, "cost", false);
        $parametres["urlImg"] = parent::getParam($_POST, "urlImg", false);
        $parametres["id"] = parent::getParam($_POST, "id", false);
        $this->controleur->displayAddUnit($parametres);
    }
}