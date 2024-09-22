<?php
declare(strict_types=1);

namespace Controllers;

use League\Plates\Engine;

class MainController {
    private Engine $engine;

    public function __construct(Engine $engine) {
        $this->engine = $engine;
    }

    public function index() : void {
        echo $this->engine->render('home', ['tftSetName' => 'Remix Rumble']);
    }
}