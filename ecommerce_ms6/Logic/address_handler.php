<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.4
 * Module name: Address Handler Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module processes a request to add a new Address to the system.
 */

require("../Database/Autoloader.php");
require("../Logic/db_funcs.php");

$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

$user = get_user();

if (no_blanks($address,$city,$state,$zip)) {
    $addressService = new AddressService();
    
    $retval = $addressService->createAddress($user->getId(), $address, $city, $state, $zip);
    
    if ($retval) {
        echo "Address created.<br>";
        
    } else {
        echo "Address not created.<br>";
    }
    echo "<a href='../Presentation/Checkout.php'>Back to Checkout</a><br>";
}
else {
    echo "You need to fill in all of the information.<br>";
    echo "<a href='../Presentation/addAddress.html'>Back</a><br>";
    
}




