<?php

class Car
{
    private $tires;
    private $hasEngine;
    private $tirePressure;
    private $isRunning;
    private $speed;
    
    public function addTires($numberOfNewTires) {
        if ($numberOfNewTires > 0 && $numberOfNewTires <= 4) {
            if ($this->tires+$numberOfNewTires > 4) {
                echo "You can only have 4 tires max.<br>";
            }
            else {
                $this->tires = $this->tires + $numberOfNewTires;
                echo "You installed " . $numberOfNewTires . " tires. You now have " . $this->tires . " tires on your car.<br>";
            }
        }
        else {
            echo "Invalid number of tires.<br>";
        }
    }
    
    public function installEngine() {
        if (!$this->hasEngine) {
            $this->hasEngine = true;
            echo "Engine has been installed.<br>";
        }
        else {
            echo "An engine is already installed.<br>";
        }
    }
    
    public function inflateTiresTo(int $pressure) {
        if ($this->tires > 0) {
            if ($pressure < 0) {
                echo "Invalid input for pressure.<br>";
            }
            else {
                $this->tirePressure = $pressure;
            }
        }
        else {
            echo "You do not have any tires installed.<br>";
        }
    }
    
    public function start() {
        if ($this->hasEngine) {
            if ($this->tires == 4) {
                if ($this->tirePressure >= 32) {
                    $this->isRunning = true;
                    echo "The car has started.<br>";
                } else {
                    echo "Tire pressure is not 32 psi or higher. Car cannot start.<br>";
                }
            } else {
                echo "There are not 4 tires installed. Car cannot start.<br>";
            }
        }
        else {
            echo "There is no engine installed. Car cannot start.<br>";
        }
    }
    
    public function stop() {
        if ($this->isRunning) {
            $this->isRunning = false;
            $this->speed = 0;
            echo "Car is now stopped.<br>";
        }
        else {
            echo "Car is already stopped.<br>";
        }
    }
    
    public function restart() {
        if ($this->isRunning) {
            $this->speed = 0;
            echo "Car has restarted.<br>";
        }
        else {
            echo "Car is not running.<br>";
        }
    }
    
    public function drive(int $speed) {
        if ($this->isRunning) {
            if ($speed > 0 && $speed <= 60) {
                $this->speed = $speed;
                echo "Car is now driving at " . $speed . " miles per hour.<br>";
            }
            else {
                echo "Speed must be between 1 and 60 inclusive.<br>";
            }
        }
        else {
            echo "Car is not running. Cannot be driven yet.<br>";
        }
    }
    
    public function brake() {
        if ($this->isRunning) {
            $this->speed = 0;
            echo "Car braked.<br>";
        }
        else {
            echo "Car is not running. No need to brake.<br>";
        }
    }
    
    public function getSpeed() {
        return $this->speed;
    }
}

