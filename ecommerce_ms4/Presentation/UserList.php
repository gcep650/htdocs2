<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: User List Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a user interface to view the list of all users that are in the system.
 */

// create back button
echo "<a href='main.php'>Back</a><br>";

ini_set('display_errors', 1);
ini_set('error_reporting', -1);

// include users service class
require_once('../Database/UsersService.php');

?>
<html>
<head>
<title>Users List</title>
<link rel="stylesheet" href="tableborder.css">
</head>
<h1>Users List</h1>
<?php
// create users service
$us = new UsersService();

// get users
$users = $us->getAllUsers();

// display the returned users
include_once('displayCustomers.php');
?>
<br><br>
<? if ($admin == 1): ?>
	<a href="createUser.html"><button type="submit">Create a New User</button></a>
<? endif;?>
</body>
</html>