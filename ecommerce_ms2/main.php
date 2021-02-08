<html>
<head>
<style>
div {
text-align: center;
</style>
</head>
<div>
<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: Main Page Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides logged in users access to website functions.
 */

session_start();

require_once('db_funcs.php');

// check if session variables 'id' and 'name' are set from login
// if true, user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
    echo "<h1>Welcome!</h1><br>";
    echo "<h4>You are logged in as: " . get_name() . "</h4><br>";
    echo "ID: " . get_id() . "<br>";
    echo "<a href='logoff.php'><button>Logoff</button></a><br><br>";
    echo "<a href='Catalog.php'><button>View Catalog</button></a><br><br>";
    echo "<a href='search.html'><button>Search Products</button></a><br><br>";
} else {
    echo "Error: User is not logged in. Access denied.<br>";
    echo "<a href='index.html'><button>Back</button></a>";
}

?>
</div>
</html>