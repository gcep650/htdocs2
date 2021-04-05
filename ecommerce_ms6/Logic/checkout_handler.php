<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.4
 * Module name: Checkout Handler Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module processes the user's credit card information. The module will be updated in the future
 * to fully process the data rather than just display it to the screen.
 */

require_once("../Logic/db_funcs.php");
require_once("../Database/Autoloader.php");

$card_number = $_POST['card_number'];
$month = $_POST['month'];
$year = $_POST['year'];
$cvv = $_POST['cvv'];
$name = $_POST['name'];
$address_id = $_POST['address'];


if (no_blanks($card_number,$month,$year,$cvv,$name,$address_id)) {
    $user = get_user();
    //$cart = new ShoppingCart($user->getId());
    $orderService = new OrdersService();
    $order = $orderService->createOrder($user->getId(), $address_id);
    echo "<a href='../Presentation/main.php'>Back to main page</a><br>";
    echo "Order created.<br>";
    include_once('../Presentation/receipt.php');
}
else {
    echo "You cannot leave any information blank.<br>";
    echo "<a href='../Presentation/Checkout.php'>Back</a><br>";
}