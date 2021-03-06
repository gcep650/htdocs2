<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Add To Cart Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module adds a specified product and quantity to the user's cart.
 */
require_once("../Database/Customer.php");
require_once("../Database/ShoppingCart.php");
require_once("../Logic/db_funcs.php");
//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

$product_id = $_POST['product'];
$quantity = $_POST['quantity'];

if (is_numeric($quantity)) {

    
    $user = get_user();
    $cart = new ShoppingCart($user->getId());
    
    $cart->addItem($product_id, $quantity);
}



header("Location: ../Presentation/Catalog.php");

