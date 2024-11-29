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

        echo $this->engine->render('home',
        [
            'tftSetName' => 'Remix Rumble',
            'resGetAll' => $allUnits,
        ]);
    }

    public function displaySearch() : void
    {
        echo $this->engine->render('search');
    }
}