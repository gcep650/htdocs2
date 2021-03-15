<html>
<!-- 
This is purely a test module. This is not a part of the application and will be removed
when the project is in a more finalized state.
 -->
<head>
<style>

table, td, th {
    border: 2px solid black;
    text-align: center;
}

</style>
</head>
</html>
<?php 
ini_set('display_errors', 1);
ini_set('error_reporting', -1);

require_once("../Database/ShoppingCart.php");

$cart = new ShoppingCart(2);

print_r($cart);

echo "<br><br>";

$cart->updateItemById(3, 10);

print_r($cart->getItems());

/*
$us = new UsersService();

$users = $us->getAllUsers();

include_once("displayCustomers.php");
*/
//require_once("../Database/Product.php");

//$p = new Product(1);

//echo $p->getName();
//$p->setName("tester");
//$p->setValues();

/*

require_once("../Database/Customer.php");

$c = new Customer(1);

echo $c->getFirstName();
*/
//echo $c->setFirstName("Bobby");
//echo $c->setValues();
/*
require_once('ProductsService.php');

$service = new ProductsService();

$products = $service->getProductsByPage(3);

include_once('displayProducts.php');
*/
?>