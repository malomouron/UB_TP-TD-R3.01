<?php

namespace Config;

use Exception;

/**
 * Classe de configuration pour gérer les paramètres de l'application.
 */
class Config {
    /**
     * @var array|null $param Tableau des paramètres de configuration.
     */
    private static ?array $param = null;

    /**
     * Renvoie la valeur d'un paramètre de configuration.
     *
     * @param string $nom Nom du paramètre.
     * @param mixed|null $valeurParDefaut Valeur par défaut si le paramètre n'existe pas.
     * @return mixed Valeur du paramètre ou valeur par défaut.
     * @throws Exception Si le fichier de configuration n'existe pas.
     */
    public static function get(string $nom, mixed $valeurParDefaut = null)
    {
        $parametres = self::getParametres();
        return $parametres[$nom] ?? $valeurParDefaut;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin.
     *
     * @return array Tableau des paramètres de configuration.
     * @throws Exception Si aucun fichier de configuration n'est trouvé.
     */
    private static function getParametres(): array {
        if (self::$param === null) {
            $cheminFichier = __DIR__ . "/prod.ini";

            if (!file_exists($cheminFichier)) {
                $cheminFichier = __DIR__ . "/dev.ini";
            }
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé: $cheminFichier");
            }

            self::$param = parse_ini_file($cheminFichier);
        }
        return self::$param;
    }
}