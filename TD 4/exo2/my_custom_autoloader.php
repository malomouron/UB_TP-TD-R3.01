<?php

/**
 * Simple autoloader
 * @param $class_name - String name for the class that is trying to be loaded.
 */
function my_custom_autoloader( $class_name ){
    $file = __DIR__ . '/includes/' .$class_name.'.php';
    if ( file_exists($file) ) {
        require_once $file;
    }
}