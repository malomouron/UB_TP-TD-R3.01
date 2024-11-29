<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;
class RouteAddUnit extends Route
{
    // Attribut pour stocker le contrôleur principal (MainController)
    private $controller;

    // Constructeur : initialise le contrôleur et appel le constructeur de la classe parente
    public function __construct($controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    // Méthode GET : appelle la méthode index() du MainController
    public function get($params = [])
    {
        $this->controller->displayAddUnit();
    }

    // Méthode POST : pour l'instant, ne fait rien
    public function post($params = [])
    {
        $origin = [parent::getParam($_POST, "origin1", true), parent::getParam($_POST, "origin2", true), parent::getParam($_POST, "origin3", true)];

        try {
            $data = [
                "name" => parent::getParam($_POST, "name", false),
                "origin" => $origin,
                "cost" => parent::getParam($_POST, "cost", false),
                "urlImg" => parent::getParam($_POST, "urlImg", false)
            ];
            echo $this->controller->displayAddUnit($data);
        } catch (Exception $e) {
            echo $this->controller->displayAddUnit(['error' => $e->getMessage()]);
        }
    }
}
