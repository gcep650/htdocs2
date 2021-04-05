<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Edit User Response Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module edits an already existing user.
 */
require_once('../Database/Customer.php');

// get information from edit page
$id = $_POST['id'];
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

$user = new Customer($id);

$user->setFirstName($first);
$user->setLastName($last);
$user->setEmail($email);
$user->setPhone($phone);
$user->setUsername($username);
$user->setPassword($password);

$result = $user->setValues();

if ($result) {
    echo "User edited successfully!<br>";
} else {
    echo "User was not edited successfully.<br>This may be caused by blank fields or an invalid username.<br>";
}
?>
<html>
<a href='../Presentation/UserList.php'>Back</a><br>
</html>