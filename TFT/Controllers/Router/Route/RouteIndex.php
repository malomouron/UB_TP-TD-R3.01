<?php

declare(strict_types=1);

namespace Controllers\Router\Route;

use Controllers\Router\Route;

class RouteIndex extends Route
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
        $this->controller->index();
    }

    // Méthode POST : pour l'instant, ne fait rien
    public function post($params = [])
    {
        $this->controller->index();
    }
}
