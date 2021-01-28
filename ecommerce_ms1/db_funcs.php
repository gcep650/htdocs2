<?php

// get mysqli connection to database
function db_con() {
    return new mysqli('localhost', 'root', 'root', 'ecommerce_db');
}

// checks if any strings passed in as an argument is blank
// returns false if there is at least one blank string
function no_blanks() {
    $strings = func_get_args();
    
    foreach($strings as $str) {
        if ($str == "" || $str == null) {
            return false;
        }
    }
    return true;
}

function set_id($id) {
    session_start();
    $_SESSION['id'] = $id;
}

function get_id() {
    session_start();
    return $_SESSION['id'];
}

function set_name($first, $last) {
    session_start();
    $_SESSION['name'] = $first . " " . $last;
}

function get_name() {
    session_start();
    return $_SESSION['name'];
}

?>