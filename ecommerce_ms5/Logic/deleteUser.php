<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Delete User Response Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module handles the request to delete a user from the database.
 */
require_once("../Database/Customer.php");
$id = $_POST['delete'];
$c = new Customer($id);
if ($c->deleteUser()) {
    echo "User was successfully deleted.<br>";
} else {
    echo "User was not successfully deleted.<br>";
}
?>
<html>
<a href='../Presentation/UserList.php'>Back</a><br>
</html>