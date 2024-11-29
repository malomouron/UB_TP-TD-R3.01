<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

class RouteDeleteUnit extends Route
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
        try {
            $data = [
                'id' => parent::getParam($_GET, "id", false),
            ];
            echo $this->controller->displayDeleteUnit($data);
        } catch (Exception $e) {
            echo $this->controller->displayDeleteUnit(['error' => $e->getMessage()]);
        }
    }

    // Méthode POST : pour l'instant, ne fait rien
    public function post($params = [])
    {
        $this->controller->displayDeleteUnit();
    }
}