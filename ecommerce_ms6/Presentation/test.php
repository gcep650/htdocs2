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

require_once("../Database/Autoloader.php");

$cs = new CouponsService();
echo $cs->checkCouponExists("testt");

//$cart = new ShoppingCart(13);
//echo $cart->destroy();

//$o = new Order(1);
//echo $o->getTotal();
/*
$os = new OrdersService();

$d1 = date("Y/m/d",strtotime("2021/04/02"));
$d2 = date("Y/m/d",time());

//echo $d1;

print_r($os->getOrdersByDate($d1, $d2));
*/
//$addService = new AddressService();

//print_r($addService->getAddressesFromUser(14));

//$p = new Product(1);
//print_r($p->jsonSerialize());

/*
$cart = new ShoppingCart(2);

print_r($cart);

echo "<br><br>";

$cart->updateItemById(3, 10);

print_r($cart->getItems());
*/
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