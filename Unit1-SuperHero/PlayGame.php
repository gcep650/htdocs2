<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once("Superman.php");
require_once("Batman.php");

$superman = new Superman();
$batman = new Batman();

while($superman->isDead() == false && $batman->isDead() == false) {
    $superman->Attack($batman);
    echo $batman->getName() . " has " . $batman->getHealth() . " health left<br>";
    $batman->Attack($superman);
    echo $superman->getName() . " has " . $superman->getHealth() . " health left<br>";
    echo "<hr>";
}
// game over, who won
if ($superman->getHealth() > 0) {
    echo "It looks like " . $batman->getName() . " lost.<br>";
}
else {
    echo "It looks like " . $superman->getName() . " was defeated.<br>";
}
?>