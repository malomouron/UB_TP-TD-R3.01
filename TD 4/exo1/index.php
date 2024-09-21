<?php

include_once 'my_custom_autoloader.php';
// add a new autoloader
spl_autoload_register( 'my_custom_autoloader' );
$my_example1 = new SomeClass1(); // using it !
$my_example2 = new SomeClass2(); // using it !

?>