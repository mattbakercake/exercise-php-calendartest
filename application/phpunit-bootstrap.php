<?php

function autoload($class) {

    $path =  __DIR__ . '/lib/' . $class . '.php';
    if (is_readable($path)) {
        include $path;
    }
}
spl_autoload_register('autoload');
