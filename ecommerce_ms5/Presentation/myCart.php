<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Customer Shopping Cart Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a user interface to view the user's shopping cart as well as
 * remove or update items
 */
require_once("../Database/Customer.php");
require_once("../Database/ShoppingCart.php");
require_once("../Database/CartItem.php");
require_once("../Database/Product.php");
require_once("../Logic/db_funcs.php");

// get the user from the session and get the shopping cart
$user = get_user();
$cart = new ShoppingCart($user->getId());

// create back button
echo "<a href='../Presentation/Catalog.php'>Back to Catalog</a><br>";
echo "<a href='../Presentation/main.php'>Back to Main Page</a><br>";

?>
<html>
<head>
<title>My Cart</title>
<link rel="stylesheet" href="tableborder.css">
</head>
<h1>My Shopping Cart</h1>
<body>
<table>
	<tr>
		<th>Product Name</th>
		<th>Product Image</th>
		<th>Product Price</th>
		<th>Quantity Purchased</th>
		<th>Total Price</th>
		<th>Actions</th>
	</tr>
<?php 

// get the items from the shopping cart and create a table holding relevant information
$items = $cart->getItems();
for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];
    //$item = new CartItem(0);
    $product = $item->getProduct();
    //$product = new Product(0);
    
    echo "<tr>";
    echo "<td>" . $product->getName() . "</td>";
    echo "<td>" . "<img src='" . $product->getImagePath() .
    "' alt='" . $product->getName() . "' style='width:100px;height:100px;'>" . "</td>";
    echo "<td>$" . $product->getPrice() . "</td>";
    
    // quantity
    echo "<td>";
    echo '<form action="../Logic/updateCartItem.php" method="post">';
    echo "<input type='hidden' id='cartitem' name='cartitem' value='" . $item->getCartItemId() . "'/>";
    echo "<input type='number' name='quantity' id='quantity' min='1' style='width:45px;' value='" . $item->getQuantity() . "'/><br><input type='submit' value='Update'/>";
    echo "</form>";
    echo "</td>";
    
    
    echo "<td>$" . $item->getQuantity() * $product->getPrice() . "</td>";
    
    // actions
    echo "<td>";
    echo '<form action="../Logic/removeFromCart.php" method="post">';
    echo "<input type='hidden' id='cartitem' name='cartitem' value='" . $item->getCartItemId() . "'/>";
    echo "<input type='submit' value='Remove from Cart'/>";
    echo "</form>";
    echo "</td>";
    
    echo "</tr>";
}


?>
</table>
<h3><b>Total: </b>$<?php echo $cart->totalPrice();?></h3><br>
<a href="../Presentation/Checkout.php">
<button>Checkout</button>
</a>
</body>
</html>