<?php
declare(strict_types=1);

namespace Controllers;

use Helpers\Message;
use League\Plates\Engine;
use Models\Origin;
use Models\OriginDAO;
use Models\UnitDAO;
use Models\Unit;

class UnitController {
    private Engine $engine;
    private UnitDAO $unitDAO;
    private OriginDAO $originDAO;
    public function __construct(Engine $engine) {
        $this->engine = $engine;
        $this->unitDAO = new UnitDAO();
        $this->originDAO = new OriginDAO();
    }

    public function displayAddUnit($params = null) : void
    {
        if (isset($params['error'])) {
            $message = new Message('Error adding unit: ' . $params['error'], 'Error', 'error');
            $this->addUnitRender($message);
        } elseif (isset($params['action']) and $params['action'] == "edit-unit") {
            if (isset($params['id'])) {
                if (!isset($params['name'])) {
                    try {
                        $unit = $this->unitDAO->getByID($params['id']);
                        if ($unit === null) {
                            $message = new Message('Unit not found', 'Error', 'error');
                            $this->addUnitRender($message);
                        } else {
                            echo $this->engine->render('add-unit',
                                [
                                    'unit' => [
                                        'id' => $unit->getId(),
                                        'name' => $unit->getName(),
                                        'cost' => $unit->getCost(),
                                        'urlimg' => $unit->getUrlImg()
                                    ],
                                    'originList' => $this->originDAO->getAll()
                                ]);
                        }
                    } catch (\Exception $e) {
                        $message = new Message('Error editing unit: ' . $e->getMessage(), 'Error', 'error');
                        $this->addUnitRender($message);
                    }
                } else {
                    $this->editUnit($params);
                }
            }
        } elseif (isset($params['name'])) {
            $params['cost'] = (int) $params['cost'];
            $this->addUnit($params);
        } else {
            $this->addUnitRender();
        }
    }

    public function displayDeleteUnit($params = null) : void
    {
        if (isset($params['error'])) {
            $message = new Message('Error deleting unit: ' . $params['error'], 'Error', 'error');
            $this->index($message);
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
            $message = new Message('Unit successfully deleted!', 'Success', 'success');
            $this->index($message);
        } catch (\Exception $e) {
            $message = new Message('Error deleting unit: ' . $e->getMessage(), 'Error', 'error');
            $this->index($message);
        }
    }

    public function addUnit(array $unitData) : void {
        try {
            $unitextract =[ 'name' => $unitData['name'], 'cost' => $unitData['cost'], 'urlImg' => $unitData['urlImg']];
            $unitextract['id'] = uniqid();
            $unit = new Unit($unitextract);
            $this->unitDAO->createUnit($unit);
            $originList = $unitData['origin'];
            foreach ($originList as $origin) {
                if ($origin !== "") {
                    $this->unitDAO->addOriginToUnit($unit->getId(), $origin);
                }
            }
            $message = new Message('Unit successfully created!', 'Success', 'success');
        } catch (\Exception $e) {
            $message = new Message('Error creating unit: ' . $e->getMessage(), 'Error', 'error');
        }
        $this->addUnitRender($message);
    }

    public function editUnit(array $dataUnit) : void {
        try {
            $dataUnit['cost'] = (int) $dataUnit['cost'];
            $unit = new Unit($dataUnit);
            $this->unitDAO->editUnitAndIndex($unit);
            $message = new Message('Unit successfully edited!', 'Success', "success");
            $this->index($message);
        } catch (\Exception $e) {
            $message = new Message('Error editing unit: ' . $e->getMessage(), 'Error', 'error');
            $this->addUnitRender($message);
        }
    }




    public function displayAddOrigin($params = null) : void
    {
        if (isset($params['error'])) {
            $message = new Message('Error adding origin: ' . $params['error'], 'Error', 'error');
            echo $this->engine->render('add-origin', ['message' => $message]);
        } elseif (isset($params['name'])) {
            $this->addOrigin($params);
        } else {
            echo $this->engine->render('add-origin');
        }
    }

    public function addOrigin(array $originData)
    {
        try {
            $origin = new Origin($originData);
            $this->originDAO->createOrigin($origin);
            $message = new Message('Origin successfully created!', 'Success', 'success');
        } catch (\Exception $e) {
            $message = new Message('Error creating origin: ' . $e->getMessage(), 'Error', 'error');
        }
        $this->index($message);
    }

    public function index(Message $message) : void {
        $allUnits = $this->unitDAO->getAll();
        foreach ($allUnits as $unit) {
            $unit->setOrigin($this->unitDAO->getOriginsForUnit($unit->getId()));
        }

        echo $this->engine->render('home',
            [
                'tftSetName' => 'Remix Rumble',
                'resGetAll' => $allUnits,
                'message' => $message
            ]);
    }

    public function addUnitRender($message = null) : void
    {
        if ($message === null) {
            echo $this->engine->render('add-unit', ['originList' => $this->originDAO->getAll()]);
        } else {
            echo $this->engine->render('add-unit', ['message' => $message, 'originList' => $this->originDAO->getAll()] );
        }
    }
}