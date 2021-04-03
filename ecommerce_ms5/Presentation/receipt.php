<?php 
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