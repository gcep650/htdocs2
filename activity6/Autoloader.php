<?php
function loadClasses($class) {
    require $class . ".php";
}
spl_autoload_register('loadClasses');