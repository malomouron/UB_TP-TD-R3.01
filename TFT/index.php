<?php
declare(strict_types=1);
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

$loader = new \Helpers\Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('\Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('\League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('\Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('\Models', __DIR__ . '/Models');
$loader->addNamespace('\Config', __DIR__ . '/Config');

$templates = new \League\Plates\Engine(__DIR__ . '/Views');

$controller = new \Controllers\MainController($templates);
$controller->index();