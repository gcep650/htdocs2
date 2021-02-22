<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Edit Product Response Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module edits an already existing product.
 */
require_once('../Database/Product.php');

// get information from edit page
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$image_path = $_POST['image_path'];

$product = new Product($id);

$product->setName($name);
$product->setDescription($description);
$product->setPrice($price);
$product->setQuantity($quantity);
$product->setImagePath($image_path);

$result = $product->setValues();

if ($result) {
    echo "Product edited successfully!<br>";
} else {
    echo "Product was not edited successfully.<br>";
}
?>
<html>
<a href='../Presentation/Catalog.php'>Back</a><br>
</html>