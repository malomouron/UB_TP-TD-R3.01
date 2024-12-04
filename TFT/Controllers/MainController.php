<?php
declare(strict_types=1);

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;

/**
 * Classe MainController pour gérer les actions principales.
 */
class MainController {
    /**
     * @var Engine $engine Moteur de templates.
     */
    private Engine $engine;

    /**
     * @var UnitDAO $unitDAO Data Access Object pour les unités.
     */
    private UnitDAO $unitDAO;

    /**
     * Constructeur : initialise le moteur de templates et le DAO des unités.
     *
     * @param Engine $engine Moteur de templates.
     */
    public function __construct(Engine $engine) {
        $this->engine = $engine;
        $this->unitDAO = new UnitDAO();
    }

    /**
     * Affiche la page d'accueil avec toutes les unités.
     *
     * @return void
     */
    public function index() : void {
        $allUnits = $this->unitDAO->getAll();
        foreach ($allUnits as $unit) {
            $unit->setOrigin($this->unitDAO->getOriginsForUnit($unit->getId()));
        }
        echo $this->engine->render('home', [
            'tftSetName' => 'Remix Rumble',
            'resGetAll' => $allUnits,
        ]);
    }
}