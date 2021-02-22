<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Database Functions Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides functions related to database access and session variable modification.
 * This module will be replaced in the future with a class that handles these actions.
 */

require_once('../Database/Customer.php');

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

function set_user(Customer $c) {
    session_start();
    $_SESSION['user'] = $c;
}

function get_user() {
    session_start();
    return $_SESSION['user'];
}

?>