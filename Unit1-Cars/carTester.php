<?php
require_once('Car.php');
echo "<b>Car 1:</b><br>";
$raceCar = new Car();

$raceCar->addTires(4);
$raceCar->installEngine();
$raceCar->inflateTiresTo(32);
$raceCar->start();
$raceCar->drive(30);
$raceCar->brake();
$raceCar->stop();

echo "<b>Car 2:</b><br>";
$raceCar2 = new Car();
$raceCar2->installEngine();
$raceCar2->addTires(-5);
$raceCar2->addTires(3);
$raceCar2->start();

$raceCar2->addTires(1);
$raceCar2->start();
$raceCar2->inflateTiresTo(35);

$raceCar2->start();
$raceCar2->drive(65);
$raceCar2->restart();

?>