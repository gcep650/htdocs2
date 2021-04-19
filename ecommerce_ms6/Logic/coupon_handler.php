<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.6
 * Module name: Coupon Handler Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module handles the user sending a coupon code request to add to the cart.
 */
require_once("../Database/Autoloader.php");
require_once("../Logic/db_funcs.php");
$coupon_code = $_POST['coupon'];
$cs = new CouponsService();

session_start();
// check if coupon code exists
if ($cs->checkCouponExists($coupon_code)) {
    // coupon code exists, check if user used coupon already
    $coupon = $cs->getCouponFromCode($coupon_code);
    if (!$cs->checkCouponUsed($coupon->getCoupon_id(), get_id())) {
        // user has not used coupon, apply to order
        $cart = new ShoppingCart(get_id());
        //echo $cart->getCart_id();
        echo $cs->addCouponToCart($cart->getCart_id(), $coupon->getCoupon_id());
        $_SESSION['msg'] = "Coupon activated successfully!";
    }
    else {
        $_SESSION['msg'] = "Coupon code invalid: You have already used this code.";
    }
}
else {
    $_SESSION['msg'] = "Coupon code invalid: Code does not exist.";
}

// redirect back to cart
header("Location: ../Presentation/myCart.php");
