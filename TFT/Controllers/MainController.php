<?php
declare(strict_types=1);

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;

class MainController {
    private Engine $engine;

    public function __construct(Engine $engine) {
        $this->engine = $engine;
    }

    public function index() : void {
        // Création d'une instance de UnitDAO
        $unitDAO = new UnitDAO();

        // 1. Récupérer toutes les unités
        $allUnits = $unitDAO->getAll();

        // 2. Récupérer une unité avec un ID existant
        $existingUnitID = 'idQuiExiste';  // Remplacer par un ID valide de la table UNIT
        $unitByIdExists = $unitDAO->getByID($existingUnitID);

        // 3. Récupérer une unité avec un ID qui n'existe pas
        $nonExistingUnitID = 'idQuiNexistePas';  // Utiliser un ID qui n'existe pas dans la table
        $unitByIdDoesNotExist = $unitDAO->getByID($nonExistingUnitID);

        echo $this->engine->render('home', ['tftSetName' => 'Remix Rumble']);

        // Afficher les résultats
        echo "<h2>Résultat de getAll():</h2>";
        foreach ($allUnits as $unit) {
            echo "ID: " . $unit->getId() . " - Name: " . $unit->getName() . " - Cost: " . $unit->getCost() . "<br>";
        }

        echo "<h2>Résultat de getByID(idQuiExiste):</h2>";
        if ($unitByIdExists) {
            echo "ID: " . $unitByIdExists->getId() . " - Name: " . $unitByIdExists->getName() . " - Cost: " . $unitByIdExists->getCost() . "<br>";
        } else {
            echo "Unité avec ID 'idQuiExiste' non trouvée.<br>";
        }

        echo "<h2>Résultat de getByID(idQuiNexistePas):</h2>";
        if ($unitByIdDoesNotExist) {
            echo "ID: " . $unitByIdDoesNotExist->getId() . " - Name: " . $unitByIdDoesNotExist->getName() . " - Cost: " . $unitByIdDoesNotExist->getCost() . "<br>";
        } else {
            echo "Unité avec ID 'idQuiNexistePas' non trouvée.<br>";
        }
    }
}