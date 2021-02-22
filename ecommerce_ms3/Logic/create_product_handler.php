<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name:Create User Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module creates a new user as specified by the admin input
 * This module will be updated in the future to use a class rather than just functions.
 */
require_once('../Database/ProductsService.php');

// get information from registration page
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$image_path = $_POST['image_path'];

$ps = new ProductsService();

$result = $ps->createProduct($name, $description, $price, $quantity, $image_path);

if ($result) {
    echo "Product created successfully!<br>";
} else {
    echo "Product was not created successfully.";
}
?>
<html>
<a href='../Presentation/Catalog.php'>Back</a><br>
</html>