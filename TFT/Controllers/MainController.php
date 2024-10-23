<?php
declare(strict_types=1);

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;

class MainController {
    private Engine $engine;
    private UnitDAO $unitDAO;
    public function __construct(Engine $engine) {
        $this->engine = $engine;
        $this->unitDAO = new UnitDAO();
    }

    public function index() : void {
        $allUnits = $this->unitDAO->getAll();
        $unitByIdExists = $this->unitDAO->getByID('1');
        $unitByIdDoesNotExist = $this->unitDAO->getByID("idQuiNexistePas");

        echo $this->engine->render('home',
        [
            'tftSetName' => 'Remix Rumble',
            'resGetAll' => $allUnits,
            'resGetByID' => $unitByIdExists,
            'reGetByIdDontExist' => $unitByIdDoesNotExist
        ]);
    }

    public function displaySearch() : void
    {
        echo $this->engine->render('search');
    }
}