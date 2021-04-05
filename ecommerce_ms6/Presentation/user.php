<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: User Display Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays a user given the ID in the URL.
 */
// create navigation buttons
echo "<a href='UserList.php'>Back</a><br>";

require_once('../Database/UsersService.php');
require_once('../Database/Customer.php');

// if no product ID is specified in url, quit loading page.
if (!isset($_GET['id'])) {
    echo "Invalid user ID.<br>";
    exit;
}

$id = $_GET['id'];

$service = new UsersService();

// get the user using the ID
$user = $service->getUserById($id);
?>
<html>
<head>
<title><?php echo $user->getFirstName() . " " . $user->getLastName();?></title>
<link rel="stylesheet" href="tableborder.css">
<style>
div {
    text-align:center;
}
</style>
</head>
<div>
<table>
<tr>
<td><h1><?php echo $user->getFirstName() . " " . $user->getLastName();?></h1></td>
</tr>
<tr>
<td><b>E-Mail Address: </b><?php echo $user->getEmail();?></td>
</tr>
<tr>
<td><b>Phone Number: </b><?php echo $user->getPhone();?></td>
</tr>
<tr>
<td><b>Username: </b><?php echo $user->getUsername();?></td>
</tr>
</table>
</div>
</html>
