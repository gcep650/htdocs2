<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once("SuperHero.php");

$ultraMan = new SuperHero("Miguel");
$unstoppable = new SuperHero("Howard");

while ($ultraMan->isHeDead() == "alive" && $unstoppable->isHeDead() == "alive") {
    $ultraMan->attack($unstoppable);
    echo $unstoppable->getName() . " has " . $unstoppable->getHealth() . " health left<br>";
    $unstoppable->attack($ultraMan);
    echo $ultraMan->getName() . " has " . $ultraMan->getHealth() . " health left<br>";
    echo "<hr>";
}

// game over, who won
if ($ultraMan->getHealth() > 0) {
    echo "It looks like " . $unstoppable->getName() . " lost.<br>";
}
else {
    echo "It looks like " . $ultraMan->getName() . " was defeated.<br>";
}

?>