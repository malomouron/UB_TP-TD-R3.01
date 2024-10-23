<?php

declare(strict_types=1);

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteIndex;

class Router
{
    // Attributs
    private $routeList = [];  // Liste des routes (ex: 'index' => RouteIndex)
    private $ctrlList = [];   // Liste des contrôleurs (ex: 'main' => MainController)
    private $action_key;      // La clé d'action dans $_GET, par défaut "action"

    private $template;        // Moteur de templates

    public function __construct($template, $name_of_action_key = 'action')
    {
        $this->action_key = $name_of_action_key;
        $this->template = $template;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList()
    {
        $this->ctrlList = [
            'main' => new MainController($this->template),
        ];
    }

    private function createRouteList()
    {
        $this->routeList = [
            'index' => new RouteIndex($this->ctrlList['main']),
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
