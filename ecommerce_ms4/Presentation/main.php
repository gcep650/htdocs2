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
 * Version: 1.3
 * Module name: Main Page Module
 * Module version: 1.2
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides logged in users access to website functions.
 */
require_once('../Database/Customer.php');
//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

session_start();

require_once('../Logic/db_funcs.php');


// check if session variable 'user' is set
// if true, user is logged in
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    include('../Presentation/cartHeader.php');
    echo "<h1>Welcome!</h1><br>";
    echo "<h4>You are logged in as: " . get_name() . "</h4><br>";
    echo "ID: " . get_id() . "<br>";
    echo "<a href='../Logic/logoff.php'><button>Logoff</button></a><br><br>";
    echo "<a href='Catalog.php'><button>View Catalog</button></a><br><br>";
    echo "<a href='search.html'><button>Search Products</button></a><br><br>";
    if ($user->isAdmin()) {
        echo "<a href='UserList.php'><button>View Users</button></a><br><br>";
    }
} else {
    echo "Error: User is not logged in. Access denied.<br>";
    echo "<a href='index.html'><button>Back</button></a>";
}

?>
</div>
</html>