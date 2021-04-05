<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Catalog Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a user interface to view the list of all products that are
 * sorted by ID and split into pages of 10 items each.
 */

// create back button
echo "<a href='main.php'>Back</a><br>";

include('../Presentation/cartHeader.php');

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

// include product service class
require_once('../Database/ProductsService.php');

$page = 0;

// if page is set in url, set page variable
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
?>
<html>
<head>
<title>Product Catalog</title>
<link rel="stylesheet" href="tableborder.css">
</head>
<h1>Product Catalog</h1>
<h4>Page <?php echo $page + 1;?></h4>
<body>
<?php
// create products service
$service = new ProductsService();

// get products
$products = $service->getProductsByPage($page);

if (count($products) <= 0) {
    echo "Invalid page number.";
}

// display the given products
include_once('displayProducts.php');
?>
<br>
<br>
<? if ($admin == 1): ?>
	<a href="createProduct.html"><button type="submit">Create a New Product</button></a>
<? endif;?>
<br><br>
<table>
<tr>
<?php 
// create page index at bottom to allow user to change pages
for ($x = 0; $x < $service->getPageCount(); $x++) {
    echo "<td><a href='Catalog.php?page=" . $x . "'>" . ($x+1) . "</a></td>";
}
?>
</tr>
</table>
</body>
</html>