<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: Logoff Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module logs the user off from the system.
 */
require_once('db_funcs.php');

session_start();

// check if id session variable is set
// this variable is set on successful login
if (isset($_SESSION['id'])) {
    session_unset();
    echo "You are now logged off.<br>";
    echo "<a href='../index.html'><button>Go to Main Page</button></a>";
}
else {
    echo "You are not logged in.<br>";
    echo "<a href='../index.html'><button>Go to Main Page</button></a>";
}