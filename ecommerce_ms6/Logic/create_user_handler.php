<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name:Create User Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module creates a new user as specified by the admin input
 * This module will be updated in the future to use a class rather than just functions.
 */
require_once('../Database/UsersService.php');

// get information from registration page
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

$us = new UsersService();

$result = $us->createUser($first, $last, $email, $phone, $username, $password);

if ($result) {
    echo "User created successfully!<br>";
} else {
    echo "User was not created successfully.<br>This may be caused by blank fields or an invalid username.<br>";
}
?>
<html>
<a href='../Presentation/UserList.php'>Back</a><br>
</html>