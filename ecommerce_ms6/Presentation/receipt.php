<?php 
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.4
 * Module name: Order Receipt Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays a receipt of the order that the user just processed.
 */
?>
<html>
<head>
<title>Receipt</title>
</head>
<body>
<h1>Receipt</h1>
<table>
<tr>
	<th>Order ID:</th>
	<td><?php echo $order->getOrder_id();?></td>
</tr>
<tr>
	<th>Total:</th>
	<td>$<?php echo $order->getTotal();?>
</tr>
<tr>
	<th>Items:</th>
	<td>
	<?php 
	$items = $order->getOrderDetails();
	foreach ($items as $item) {
	    echo $item->getProduct()->getName() . "<br>";
	}
	?>
	</td>
</tr>
</table>
</body>
</html>