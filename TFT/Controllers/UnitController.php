<?php
declare(strict_types=1);

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;

class UnitController {
    private Engine $engine;
    private UnitDAO $unitDAO;
    public function __construct(Engine $engine) {
        $this->engine = $engine;
        $this->unitDAO = new UnitDAO();
    }

    public function displayAddUnit() : void
    {
        echo $this->engine->render('add-unit');
    }
}