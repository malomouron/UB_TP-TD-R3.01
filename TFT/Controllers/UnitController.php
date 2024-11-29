<?php
declare(strict_types=1);

namespace Controllers;

use League\Plates\Engine;
use Models\UnitDAO;
use Models\Unit;

class UnitController {
    private Engine $engine;
    private UnitDAO $unitDAO;
    public function __construct(Engine $engine) {
        $this->engine = $engine;
        $this->unitDAO = new UnitDAO();
    }

    public function displayAddUnit($params = null) : void
    {
        if (isset($params['error'])) {
            echo $this->engine->render('add-unit', ['message' => "Error : ".$params['error']]);
        } elseif (isset($params['action']) and $params['action'] == "edit-unit") {
            if (isset($params['id'])) {
                if (!isset($params['name'])) {
                    $unit = $this->unitDAO->getByID($params['id']);
                    echo $this->engine->render('add-unit', ['unit' => [
                        'id' => $unit->getId(),
                        'name' => $unit->getName(),
                        'origin' => $unit->getOrigin(),
                        'cost' => $unit->getCost(),
                        'urlimg' => $unit->getUrlImg()
                    ]]);
                } else {
                    $this->editUnit($params);
                }
            }
        } elseif (isset($params['name'])) {
            $params['cost'] = (int) $params['cost'];
            $this->addUnit($params);
        } else {
            echo $this->engine->render('add-unit');
        }
    }

    public function displayDeleteUnit($params = null) : void
    {
        if (isset($params['error'])) {
            $this->index("Error : ".$params['error']);
        } else {
            $this->deleteUnit($params['id']);
        }
    }

    public function deleteUnit(string $id) : void {
        try {
            $rowCount = $this->unitDAO->deleteUnit($id);
            if ($rowCount === 0) {
                throw new \Exception('Unit not found');
            }
            $this->index('Unit successfully deleted');
        } catch (\Exception $e) {
            $this->index("Error : ".$e->getMessage());
        }
    }

    public function addUnit(array $unitData) : void {
        try {
            $unitData['id'] = uniqid();
            $unit = new Unit($unitData);
            $this->unitDAO->createUnit($unit);
            $message = 'Unit successfully created!';
        } catch (\Exception $e) {
            $message = 'Error creating unit: ' . $e->getMessage();
        }
        echo $this->engine->render('add-unit', ['message' => $message]);
    }

    public function editUnit(array $dataUnit) : void {
        try {
            $dataUnit['cost'] = (int) $dataUnit['cost'];
            $unit = new Unit($dataUnit);
            $this->unitDAO->editUnitAndIndex($unit);
            $message = 'Unit successfully edited!';
            $this->index($message);
        } catch (\Exception $e) {
            echo $this->engine->render('add-unit', ['message' => "Error : ".$e]);
        }
    }




    public function displayAddOrigin()
    {
        echo $this->engine->render('add-origin');
    }

    public function addOrigin(array $originData)
    {
        try {
            $originData['id'] = uniqid();
            $origin = new Origin($originData);
            $this->originDAO->createOrigin($origin);
            $message = 'Origin successfully created!';
        } catch (\Exception $e) {
            $message = 'Error creating origin: ' . $e->getMessage();
        }
        $this->index($message);
    }

    public function index(string $message = "") : void {
        $allUnits = $this->unitDAO->getAll();

        echo $this->engine->render('home',
            [
                'tftSetName' => 'Remix Rumble',
                'resGetAll' => $allUnits,
                'message' => $message
            ]);
    }
}