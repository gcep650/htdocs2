<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: Product Display Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays a product given its ID number in the URL.
 */
// create navigation buttons
echo "<a href='Catalog.php'>Back to Catalog</a><br>";
echo "<a href='search.html'>Back to Search</a><br>";

require_once('../Database/ProductsService.php');

// if no product ID is specified in url, quit loading page.
if (!isset($_GET['id'])) {
    echo "Invalid product ID.<br>";
    exit;
}

$id = $_GET['id'];

$service = new ProductsService();

// get the producr using the ID
$product = $service->getProductById($id);
?>
<html>
<head>
<title><?php echo $product['NAME'];?></title>
<link rel="stylesheet" href="tableborder.css">
<style>
div {
    text-align:center;
}
</style>
</head>
<div>
<table>
<tr>
<td><h1><?php echo $product['NAME'];?></h1></td>
</tr>
<tr>
<td><img src="<?php echo $product['IMAGE_PATH'];?>" alt="<?php echo $product['NAME'];?>" style='width:500px;height:500px;'></td>
</tr>
<tr>
<td><b>Description: </b><?php echo $product['DESCRIPTION'];?></td>
</tr>
<tr>
<td><b>Quantity: </b><?php echo $product['QUANTITY'];?></td>
</tr>
<tr>
<td><b>Price: $</b><?php echo $product['PRICE'];?></td>
</tr>
</table>
</div>
</html>
