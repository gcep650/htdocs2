<?php
spl_autoload_register(function($class) {
    $fileName = $class . ".php";
    
    if (is_readable($fileName)) {
        require($fileName);
    }
    
} );