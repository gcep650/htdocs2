<?php 
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.5
 * Module name: Order Panel Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays an array of Order objects under the name of $orders
 */

/*
$orders = array();
array_push($orders, new Order(1));
array_push($orders,new Order(2));
*/

?>
<table>
	<tr>
		<th>Order ID</th>
		<th>User</th>
		<th>Date Ordered</th>
		<th>Products Ordered</th>
	</tr>
<?php 
foreach ($orders as $order) {
    echo "<tr>";
    $user = new Customer($order->getUser_id());
    echo "<td>" . $order->getOrder_id() . "</td>";
    echo "<td>" . $user->getUsername() . "</td>";
    echo "<td>" . $order->getDate() . "</td><td>";
    $odlist = $order->getOrderDetails();
    include("displayOrderDetails.php");
    echo "</td></tr>";
}

?>
</table>