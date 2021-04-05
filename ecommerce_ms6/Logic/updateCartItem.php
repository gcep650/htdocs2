<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Update Cart Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module updates an item from the user's shopping cart.
 */
require_once("../Database/Customer.php");
require_once("../Database/ShoppingCart.php");
require_once("../Logic/db_funcs.php");

$cart_item_id = $_POST['cartitem'];
$quantity = $_POST['quantity'];

$user = get_user();
$cart = new ShoppingCart($user->getId());

$cart->updateItem($cart_item_id, $quantity);

header("Location: ../Presentation/myCart.php");