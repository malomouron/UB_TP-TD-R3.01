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
use League\Plates\Engine;

/**
 * Classe Router pour gérer le routage des requêtes.
 */
class Router
{
    /**
     * @var array $listeRoutes Liste des routes (ex: 'index' => RouteIndex).
     */
    private array $listeRoutes = [];

    /**
     * @var array $listeControleurs Liste des contrôleurs (ex: 'main' => MainController).
     */
    private array $listeControleurs = [];

    /**
     * @var string $cleAction La clé d'action dans $_GET, par défaut "action".
     */
    private string $cleAction;

    /**
     * @var Engine $moteur Moteur de templates.
     */
    private Engine $moteur;

    /**
     * Constructeur : initialise le moteur de templates et la clé d'action.
     *
     * @param Engine $template Moteur de templates.
     * @param string $nomCleAction Nom de la clé d'action.
     */
    public function __construct(Engine $template, string $nomCleAction = 'action')
    {
        $this->cleAction = $nomCleAction;
        $this->moteur = $template;
        $this->creerListeControleurs();
        $this->creerListeRoutes();
    }

    /**
     * Crée la liste des contrôleurs.
     *
     * @return void
     */
    private function creerListeControleurs(): void
    {
        $this->listeControleurs = [
            'main' => new MainController($this->moteur),
            'unit' => new UnitController($this->moteur),
        ];
    }

    /**
     * Crée la liste des routes.
     *
     * @return void
     */
    private function creerListeRoutes(): void
    {
        $this->listeRoutes = [
            'index' => new RouteIndex($this->listeControleurs['main']),
            'add-unit' => new RouteAddUnit($this->listeControleurs['unit']),
            'search' => new RouteSearch($this->listeControleurs['unit']),
            'add-origin' => new RouteAddOrigin($this->listeControleurs['unit']),
            'del-unit' => new RouteDeleteUnit($this->listeControleurs['unit']),
            'edit-unit' => new RouteEditUnit($this->listeControleurs['unit']),
        ];
    }

    /**
     * Gère le routage des requêtes en fonction des paramètres GET et POST.
     *
     * @param array $get Paramètres GET.
     * @param array $post Paramètres POST.
     * @return void
     * @throws Exception Si la route n'est pas trouvée.
     */
    public function routing(array $get, array $post): void
    {
        if (isset($get[$this->cleAction])) {
            $cleRoute = $get[$this->cleAction];

            if (isset($this->listeRoutes[$cleRoute])) {
                $methode = !empty($post) ? 'POST' : 'GET'; // Vérifie si c'est une requête POST ou GET
                $this->listeRoutes[$cleRoute]->action($get, $methode);
            } else {
                throw new Exception("Route '$cleRoute' non trouvée.");
            }
        } else {
            // Si aucune action n'est spécifiée, on redirige vers l'index
            $this->listeRoutes['index']->action($get, 'GET');
        }
    }
}