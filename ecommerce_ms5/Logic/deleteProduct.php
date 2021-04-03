<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Delete Product Response Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module handles the request to delete a product from the database.
 */
require_once("../Database/Product.php");
$id = $_POST['delete'];
$p = new Product($id);
if ($p->deleteProduct()) {
    echo "Product was successfully deleted.<br>";
} else {
    echo "Product was not successfully deleted.<br>";
}
?>
<html>
<a href='../Presentation/Catalog.php'>Back</a><br>
</html>