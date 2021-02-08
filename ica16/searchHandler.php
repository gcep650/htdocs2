<?php

require_once("UserBusinessService.php");

echo "<h1>Search Results</h1><br>";

$searchPhrase = $_POST['name'];

$service = new UserBusinessService();

$persons = $service->searchByFirstName($searchPhrase);

if ($persons) {
    include('_displayAllUsers.php');
}
else {
    echo "No search results were found.";
}