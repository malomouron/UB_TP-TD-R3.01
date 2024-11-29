<?php

namespace Controllers\Router\Route;


use Controllers\Router\Route;

class RouteEditUnit extends Route
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
        $this->controller->displayAddUnit($params);
    }

    // Méthode POST : pour l'instant, ne fait rien
    public function post($params = [])
    {
        $params["name"]  = parent::getParam($_POST, "name", false);
        $params["origin"]  = parent::getParam($_POST, "origin", false);
        $params["cost"]  = parent::getParam($_POST, "cost", false);
        $params["urlImg"]  = parent::getParam($_POST, "urlImg", false);
        $params["id"]  = parent::getParam($_POST, "id", false);
        $this->controller->displayAddUnit($params);
    }
}