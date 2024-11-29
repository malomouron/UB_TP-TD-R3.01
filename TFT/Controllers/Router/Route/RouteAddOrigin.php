<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteAddOrigin extends Route
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
        $this->controller->displayAddOrigin();
    }

    // Méthode POST : pour l'instant, ne fait rien
    public function post($params = [])
    {
        try {
            $data = [
                "name" => parent::getParam($_POST, "name", false),
                "urlImg" => parent::getParam($_POST, "urlImg", false)
            ];
            echo $this->controller->displayAddOrigin($data);
        } catch (Exception $e) {
            echo $this->controller->displayAddOrigin(['error' => $e->getMessage()]);
        }
    }
}
