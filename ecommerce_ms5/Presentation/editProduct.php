<?php 
require_once("../Database/Product.php");

$id = $_POST['edit'];

$p = new Product($id);
?>
<!DOCTYPE html>
<!-- 
Project Name: CST-236 Ecommerce Application
Version: 1.2
Module name: Edit Product Page
Module version: 1.0
Authors: Gabriel Cepleanu
Synopsis: This module provides a UI for an administrator to edit an existing product.
 -->
<html>
<head>
<meta charset="ISO-8859-1">
<title>Edit Product</title>
<link rel="stylesheet" href="centering.css">
<style>
table {
text-align: center;
}

</style>
</head>
<body>
<div>
<a href='Catalog.php'><button>Back</button></a>
<form action="../Logic/edit_product_handler.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<table>
	<tr>
		<td colspan="2"><h1>Edit an existing product</h1></td>
	</tr>
	<tr>
		<th>Product name:</th>
		<td><input type="text" name="name" value="<?php echo $p->getName();?>"/></td>
	</tr>
	<tr>
		<th>Product description:</th>
		<td><input type="text" name="description" value="<?php echo $p->getDescription();?>"/></td>
	</tr>
	<tr>
		<th>Product price:</th>
		<td><input type="text" name="price" value="<?php echo $p->getPrice();?>"/></td>
	</tr>
	<tr>
		<th>Quantity of product:</th>
		<td><input type="text" name="quantity" value="<?php echo $p->getQuantity();?>"/></td>
	</tr>
	<!-- will eventually add feature to upload photo -->
	<tr>
		<th>Image path:</th>
		<td><input type="text" name="image_path" value="<?php echo $p->getImagePath();?>"/></td>
	</tr>
	<tr>
	<td colspan="2"><input type="submit" value="Update Product"/></td>
	</tr>
</table>
</form>
</div>
</body>
</html>