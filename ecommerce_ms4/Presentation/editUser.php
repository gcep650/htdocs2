<?php 
require_once("../Database/Customer.php");

$id = $_POST['edit'];

$c = new Customer($id);
?>
<!DOCTYPE html>
<!-- 
Project Name: CST-236 Ecommerce Application
Version: 1.2
Module name: Edit User Page
Module version: 1.0
Authors: Gabriel Cepleanu
Synopsis: This module provides a UI for an administrator to Edit a new user.
 -->
<html>
<head>
<meta charset="ISO-8859-1">
<title>Edit User</title>
<link rel="stylesheet" href="centering.css">
<style>
table {
text-align: center;
}

</style>
</head>
<body>
<div>
<a href='../Presentation/UserList.php'><button>Back</button></a>
<form action="../Logic/edit_user_handler.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<table>
	<tr>
		<td colspan="2"><h1>Edit existing user</h1></td>
	</tr>
	<tr>
		<th>First name:</th>
		<td><input type="text" name="first" value="<?php echo $c->getFirstName(); ?>"/></td>
	</tr>
	<tr>
		<th>Last name:</th>
		<td><input type="text" name="last" value="<?php echo $c->getLastName(); ?>"/></td>
	</tr>
	<tr>
		<th>Email Address:</th>
		<td><input type="text" name="email" value="<?php echo $c->getEmail(); ?>"/></td>
	</tr>
	<tr>
		<th>Phone Number:</th>
		<td><input type="text" name="phone" value="<?php echo $c->getPhone(); ?>"/></td>
	</tr>
	<tr>
		<th>Username:</th>
		<td><input type="text" name="username" value="<?php echo $c->getUsername(); ?>"/></td>
	</tr>
	<tr>
		<th>Password:</th>
		<td><input type="text" name="password" value="<?php echo $c->getPassword(); ?>"/></td>
	</tr>
	<tr>
	<td colspan="2"><input type="submit" value="Update"/></td>
	</tr>
</table>
</form>
</div>
</body>
</html>