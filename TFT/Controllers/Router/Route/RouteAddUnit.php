<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

/**
 * Classe RouteAddUnit pour gérer les routes d'ajout d'unité.
 */
class RouteAddUnit extends Route
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
        $this->controleur->displayAddUnit();
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
        $origines = [
            parent::getParam($_POST, "origin1"),
            parent::getParam($_POST, "origin2"),
            parent::getParam($_POST, "origin3")
        ];

        try {
            $donnees = [
                "name" => parent::getParam($_POST, "name", false),
                "origin" => $origines,
                "cost" => parent::getParam($_POST, "cost", false),
                "urlImg" => parent::getParam($_POST, "urlImg", false)
            ];
            echo $this->controleur->displayAddUnit($donnees);
        } catch (Exception $e) {
            echo $this->controleur->displayAddUnit(['erreur' => $e->getMessage()]);
        }
    }
}