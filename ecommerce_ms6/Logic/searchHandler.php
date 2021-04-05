<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: Search Handler Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module processes a search request and displays the results.
 */
echo "<a href='../Presentation/search.html'>Back</a><br>";

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

// if there is no query in the url, stop loading page
if(!isset($_GET['query'])) {
    echo "Invalid search query.<br>";
    exit;
}
    
$search = $_GET['query'];

$type = "contains";

// if type is specified, get it from url
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

require_once('../Database/ProductsService.php');

$service = new ProductsService();

// run the search function from the ProductsService instance
$products = $service->searchByName($search, $type);

if (count($products) <= 0) {
    echo "No search results found. Try another query?<br>";
    exit;
}

?>
<html>
<head>
<title>Search Results</title>
<link rel="stylesheet" href="../Presentation/tableborder.css">
</head>
<h1>Search Results</h1>
<h4>There were <?php echo count($products);?> result(s) found.</h4>
<?php 
// display the search results
include_once('../Presentation/displayProducts.php');
?>
</html>