<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

/**
 * Classe RouteDeleteUnit pour gérer les routes de suppression d'unité.
 */
class RouteDeleteUnit extends Route
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
     * Méthode GET : appelle la méthode displayDeleteUnit() du MainController.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function get(array $parametres = []): void
    {
        try {
            $donnees = [
                'id' => parent::getParam($_GET, "id", false),
            ];
            echo $this->controleur->displayDeleteUnit($donnees);
        } catch (Exception $e) {
            echo $this->controleur->displayDeleteUnit(['error' => $e->getMessage()]);
        }
    }

    /**
     * Méthode POST : pour l'instant, ne fait rien.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void
     */
    public function post(array $parametres = []): void
    {
        $this->controleur->displayDeleteUnit();
    }
}