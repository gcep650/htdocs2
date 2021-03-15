<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Shopping Cart Header Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a small header in the top right corner of the page that shows
 * the number of items in the user's cart as well as a button to view the cart.
 */
require_once("../Database/ShoppingCart.php");
require_once("../Database/Customer.php");

session_start();

// make sure user is logged in
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    
    // create new shoppingcart instance from user id
    $cart = new ShoppingCart($user->getId());
    
}
?>
<div style="text-align:right;">
<table align="right">
	<tr>
		<th>My Cart: </th>
		<td><?php echo $cart->itemCount();?> Items</td>
	</tr>
	<tr>
		<td colspan="2">
		<a href="../Presentation/myCart.php">
		<button>View Cart</button>
		</a>
		</td>
	</tr>
</table>
</div>
<br>