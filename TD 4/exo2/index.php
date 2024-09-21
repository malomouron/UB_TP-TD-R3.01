<?php

include_once 'my_custom_autoloader.php';
spl_autoload_register( 'my_custom_autoloader' );

use Fruit\Orange as FruitOrange;
use Color\Orange as ColorOrange;

$fruitOrange = new FruitOrange();
$colorOrange = new ColorOrange();

echo $fruitOrange;
echo $colorOrange;