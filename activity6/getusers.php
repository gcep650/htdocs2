<?php
require("Autoloader.php");

$users = array();

$u1 = new User(1,"Bob","Flanders");
$u2 = new User(2, "Susan","McCarthy");
$u3 = new User(3, "Joe","Oakwood");
$u4 = new User(4, "Thomas","Jones");
$u5 = new User(5, "Adam","Lake");

array_push($users,$u1,$u2,$u3,$u4,$u5);

$json = json_encode($users);

echo $json;