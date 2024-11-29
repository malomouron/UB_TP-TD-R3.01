<?php

declare(strict_types=1);

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteAddOrigin;
use Controllers\Router\Route\RouteAddUnit;
use Controllers\Router\Route\RouteDeleteUnit;
use Controllers\Router\Route\RouteEditUnit;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteSearch;
use Controllers\UnitController;
use Exception;

class Router
{
    // Attributs
    private $routeList = [];  // Liste des routes (ex: 'index' => RouteIndex)
    private $ctrlList = [];   // Liste des contrôleurs (ex: 'main' => MainController)
    private $action_key;      // La clé d'action dans $_GET, par défaut "action"

    private $engine;        // Moteur de templates

    public function __construct($template, $name_of_action_key = 'action')
    {
        $this->action_key = $name_of_action_key;
        $this->engine = $template;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList()
    {
        $this->ctrlList = [
            'main' => new MainController($this->engine),
            'unit' => new UnitController($this->engine),
        ];

    }

    private function createRouteList()
    {
        $this->routeList = [
            'index' => new RouteIndex($this->ctrlList['main']),
            'add-unit' => new RouteAddUnit($this->ctrlList['unit']),
            'search' => new RouteSearch($this->ctrlList['main']),
            'add-origin' => new RouteAddOrigin($this->ctrlList['unit']),
            'del-unit' => new RouteDeleteUnit($this->ctrlList['unit']),
            'edit-unit' => new RouteEditUnit($this->ctrlList['unit']),
        ];
    }

    public function routing($get, $post)
    {
        if (isset($get[$this->action_key])) {
            $routeKey = $get[$this->action_key];

            if (isset($this->routeList[$routeKey])) {
                $method = !empty($post) ? 'POST' : 'GET'; // Vérifie si c'est une requête POST ou GET
                $this->routeList[$routeKey]->action($get, $method);
            } else {
                throw new Exception("Route '$routeKey' non trouvée.");
            }
        } else {
            // Si aucune action n'est spécifiée, on redirige vers l'index
            $this->routeList['index']->action($get, 'GET');
        }
    }
}
