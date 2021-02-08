<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: Display Products Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays a list of products given as a 2D array of $products
 */
// start creating table
echo "<table>";
// iterate through products array
for ($i = 0; $i < count($products); $i++) {
    // create table headers
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Image</th><th>Actions</th></tr>";
    echo "<tr>";
    // print product information
    echo "<td>" . $products[$i]['PRODUCT_ID'] . "</td>" . "<td>" . $products[$i]['NAME'] . "</td>" . 
        "<td>" . $products[$i]['DESCRIPTION'] . "</td>" . "<td>$" . $products[$i]['PRICE'] . "</td>" . 
        "<td>" . $products[$i]['QUANTITY'] . "</td>" . "<td>" . "<img src='" . $products[$i]['IMAGE_PATH'] . 
        "' alt='" . $products[$i]['NAME'] . "' style='width:100px;height:100px;'>" . "</td>";
    // print View Product button
    echo "<td><a href='product.php?id=" . $products[$i]['PRODUCT_ID'] . "'>View Product</a></td>";
    echo "</tr>";
}
echo "</table>";