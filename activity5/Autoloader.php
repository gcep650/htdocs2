<?php
function myAutoloader($class) {
    require $class . ".php";
}
spl_autoload_register('myAutoloader');