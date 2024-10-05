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

    public function index($resGetAll, $resGetByID, $reGetByIdDontExist) : void {

        echo $this->engine->render('home',
            [
                'tftSetName' => 'Remix Rumble',
                'resGetAll' => $resGetAll,
                'resGetByID' => $resGetByID,
                'reGetByIdDontExist' => $reGetByIdDontExist
            ]);
    }
}