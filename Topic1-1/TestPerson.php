<?php
require_once("Person.php");

$personOne = new Person("Mark");
$personOne->walk();

$personTwo = new Person("Edward");
$personTwo->formalGreeting();

$personThree = new Person("Juan");
$personThree->spanishGreeting();

$personThree->login("shad", "asdf");
$personThree->login("bob","qwerty");
?>