<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Checkout Handler Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module processes the user's credit card information. The module will be updated in the future
 * to fully process the data rather than just display it to the screen.
 */
$card_number = $_POST['card_number'];
$month = $_POST['month'];
$year = $_POST['year'];
$cvv = $_POST['cvv'];
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

echo $card_number . "<br>" . $month . "<br>" . $year . "<br>" . $cvv . "<br>" . $name . "<br>" . $address
. "<br>" . $city . "<br>" . $state . "<br>" . $zip;