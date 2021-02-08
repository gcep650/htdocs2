<html>
<!-- 
This is purely a test module. This is not a part of the application and will be removed
when the project is in a more finalized state.
 -->
<head>
<style>

table, td, th {
    border: 2px solid black;
    text-align: center;
}

</style>
</head>
</html>
<?php 
ini_set('display_errors', 1);
ini_set('error_reporting', -1);

require_once('ProductsService.php');

$service = new ProductsService();

$products = $service->getProductsByPage(3);

include_once('displayProducts.php');

?>