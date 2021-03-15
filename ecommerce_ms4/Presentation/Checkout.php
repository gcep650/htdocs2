<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Checkout Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a user interface to allow the user to checkout and fill out their
 * credit card details
 */
// create back button
echo "<a href='../Presentation/myCart.php'>Back</a><br>";
require_once("../Database/Customer.php");
require_once("../Database/ShoppingCart.php");
require_once("../Logic/db_funcs.php");

$user = get_user();
$cart = new ShoppingCart($user->getId());
?>
<html>
<head>
<title>Checkout</title>
<link rel="stylesheet" href="centering.css">
<style>
table {
text-align: center;
}

</style>
</head>
<body>
<form action="../Logic/checkout_handler.php" method="post">
<div>	
<h1>Checkout</h1>
<h3><b>Total: $</b><?php echo $cart->totalPrice();?></h3>
<table>
	<tr>
		<th>Card Number:</th>
		<td><input type="text" id="card_number" name="card_number" /></td>
	</tr>
	<tr>
		<th>Expiration Date:</th>
		<td>
		<input type="number" min="1" max="12" id="month" name="month" style="width:70px;"/>
		/
		<input type="number" min="1900" id="year" name="year" style="width:70px;"/>
		</td>
	</tr>
	<tr>
		<th>CVV</th>
		<td><input type="number" min="0" id="cvv" name="cvv" style="width:70px;"/></td>
	</tr>
	<tr>
		<th>Name on Card:</th>
		<td><input type="text" id="name" name="name"/></td>
	</tr>
	<tr>
		<th colspan="2">Billing Address</th>
	</tr>
	<tr>
		<th>Address</th>
		<td><input type="text" id="address" name="address"/></td>
	</tr>
	<tr>
		<th>City</th>
		<td><input type="text" id="city" name="city"/></td>
	</tr>
	<tr>
		<th>State</th>
		<td><input type="text" id="state" name="state"/></td>
	</tr>
	<tr>
		<th>Zip Code</th>
		<td><input type="number" min="0" id="zip" name="zip"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Checkout"/></td>
	</tr>
</table>
</div>
</form>
</body>
</html>