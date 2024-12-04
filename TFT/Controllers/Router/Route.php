<?php

declare(strict_types=1);

namespace Controllers\Router;

use Exception;

/**
 * Classe abstraite Route pour gérer les routes.
 */
abstract class Route
{
    /**
     * Constructeur de la classe Route.
     */
    public function __construct()
    {
    }

    /**
     * Exécute l'action en fonction de la méthode HTTP.
     *
     * @param array $parametres Paramètres de la requête.
     * @param string $methode Méthode HTTP (GET ou POST).
     * @return void Résultat de l'action.
     */
    public function action(array $parametres = [], string $methode = 'GET'): void
    {
        if ($methode === 'POST') {
            $this->post($parametres);
        } elseif ($methode === 'GET') {
            $this->get($parametres);
        }
    }

    /**
     * Récupère un paramètre d'un tableau.
     *
     * @param array $tableau Tableau contenant les paramètres.
     * @param string $nomParam Nom du paramètre à récupérer.
     * @param bool $peutEtreVide Indique si le paramètre peut être vide.
     * @return mixed Valeur du paramètre.
     * @throws Exception Si le paramètre est absent ou vide (si $peutEtreVide est false).
     */
    protected function getParam(array $tableau, string $nomParam, bool $peutEtreVide = true)
    {
        if (isset($tableau[$nomParam])) {
            // Si le paramètre ne peut pas être vide et qu'il l'est, on lance une exception
            if (!$peutEtreVide && empty($tableau[$nomParam])) {
                throw new Exception("Paramètre '$nomParam' vide");
            }
            return $tableau[$nomParam];
        } else {
            // Si le paramètre n'existe pas, on lance une exception
            throw new Exception("Paramètre '$nomParam' absent");
        }
    }

    /**
     * Méthode abstraite pour gérer les requêtes GET.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void Résultat de la requête.
     */
    abstract public function get(array $parametres = []): void;

    /**
     * Méthode abstraite pour gérer les requêtes POST.
     *
     * @param array $parametres Paramètres de la requête.
     * @return void Résultat de la requête.
     */
    abstract public function post(array $parametres = []): void;
}