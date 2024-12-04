<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

/**
 * Classe RouteAddOrigin pour gérer les routes d'ajout d'origine.
 */
class RouteAddOrigin extends Route
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
     * Méthode GET : appelle la méthode displayAddOrigin() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function get(array $parametres = []): void
    {
        $this->controleur->displayAddOrigin();
    }

    /**
     * Méthode POST : traite les données du formulaire et appelle la méthode displayAddOrigin() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function post(array $parametres = []): void
    {
        try {
            $donnees = [
                "nom" => parent::getParam($_POST, "name", false),
                "urlImg" => parent::getParam($_POST, "urlImg", false)
            ];
            echo $this->controleur->displayAddOrigin($donnees);
        } catch (Exception $e) {
            echo $this->controleur->displayAddOrigin(['erreur' => $e->getMessage()]);
        }
    }
}