<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once("Person.php");
require_once("Student.php");

$newGuy1 = new Person();
$newGuy2 = new Student();

$newGuy1->growOlderBy(2);
$newGuy2->growOlderBy(2);

echo "The age of person 1 is " . $newGuy1->age . "<br>";
echo "The age of person 2 is " . $newGuy2->age . "<br>";
