<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Display Products Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays a list of products given as a 2D array of $products
 */
require_once("../Database/Customer.php");
session_start();
// start creating table
echo "<table>";
if (isset($_SESSION['user'])) {
    $admin = $_SESSION['user']->getAdmin();
}
// iterate through products array
for ($i = 0; $i < count($products); $i++) {
    // create table headers
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Image</th><th colspan=3>Actions</th></tr>";
    echo "<tr>";
    // print product information
    echo "<td>" . $products[$i]['PRODUCT_ID'] . "</td>" . "<td>" . $products[$i]['NAME'] . "</td>" . 
        "<td>" . $products[$i]['DESCRIPTION'] . "</td>" . "<td>$" . $products[$i]['PRICE'] . "</td>" . 
        "<td>" . $products[$i]['QUANTITY'] . "</td>" . "<td>" . "<img src='" . $products[$i]['IMAGE_PATH'] . 
        "' alt='" . $products[$i]['NAME'] . "' style='width:100px;height:100px;'>" . "</td>";
    // print View Product button
    echo "<td><a href='../Presentation/productDisplay.php?id=" . $products[$i]['PRODUCT_ID'] . "'><button name='view' type='submit' value='view'>View Product</button></a></td>";
    if ($admin == 1) {
        echo '<form action="../Logic/deleteProduct.php" method="post">';
        echo '<td><button name="delete" type="submit" value=' . $products[$i]['PRODUCT_ID'] . '>Delete Product</button></td></form>';
        echo '<form action="../Presentation/editProduct.php" method="post">';
        echo '<td><button name="edit" type="submit" value=' . $products[$i]['PRODUCT_ID'] . '>Edit Product</button></td></form>';
    }
    echo "</tr>";
}
echo "</table>";