<?php 
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.5
 * Module name: Order Details Panel Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays an array of OrderDetails objects given as $odlist
 */
?>
<table>
<tr>
	<th>Product Name</th>
	<th>Product Image</th>
	<th>Quantity Ordered</th>
</tr>
<?php 
foreach ($odlist as $od) {
    $prod = $od->getProduct();
    echo "<tr>";
    echo "<td>" . $prod->getName() . "</td>";
    echo "<td><img src='" . $prod->getImagePath() . "' alt='" . $prod->getName() . "' style='width:100px;height:100px;'></td>";
    echo "<td>" . $od->getQuantity() . "</td>";
    echo "</tr>";
}
?>
</table>