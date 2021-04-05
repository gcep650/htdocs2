<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.5
 * Module name: Sales Reports Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a UI for the user to view a list of products purchased during
 * a given time frame. After the user submits two dates, the page shows the results.
 */
require("../Database/Autoloader.php");
echo "<a href='main.php'>Back</a><br>";
//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);
?>
<html>
<head>
<title>Sales Reports</title>
<link rel="stylesheet" href="tableborder.css">
</head>
<body>
<h1>Sales Reports</h1>
<form action="salesReports.php" method="get">
<table>
<tr>
	<th>Start Date</th>
	<td><input type="date" name="start" id="start" /></td>
</tr>
<tr>
	<th>End Date</th>
	<td><input type="date" name="end" id="end" /></td>
</tr>
<tr>
	<td colspan="2"><input type="submit" value="Show Results"/></td>
</tr>
</table>
</form>
<?php 
if (!isset($_GET['start']) || !isset($_GET['end'])) {
    echo "</body></html>";
    exit();
}
$d1 = date("Y/m/d",strtotime($_GET['start']));
$d2 = date("Y/m/d",strtotime($_GET['end']));

$os = new OrdersService();
$orders = $os->getOrdersByDate($d1, $d2);
include("orderPanel.php");
?>
</body>
</html>