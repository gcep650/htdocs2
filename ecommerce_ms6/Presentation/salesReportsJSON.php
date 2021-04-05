<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.5
 * Module name: Sales Reports JSON Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides JSON of a list of purchased products within a given timespan
 */
require_once("../Database/Autoloader.php");
//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);
if (!isset($_GET['start']) || !isset($_GET['end'])) {
    echo "Invalid input for URL. You must have a start date and end date.";
    exit();
}
$d1 = date("Y/m/d",strtotime($_GET['start']));
$d2 = date("Y/m/d",strtotime($_GET['end']));

$os = new OrdersService();
$orders = $os->getOrdersByDate($d1, $d2);
echo json_encode($orders);
