<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Remove From Cart Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module removes a specified product from the user's cart.
 */
require_once("../Database/Customer.php");
require_once("../Database/ShoppingCart.php");
require_once("../Logic/db_funcs.php");

$cart_item_id = $_POST['cartitem'];

$user = get_user();
$cart = new ShoppingCart($user->getId());

$cart->removeItem($cart_item_id);

header("Location: ../Presentation/myCart.php");