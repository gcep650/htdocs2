<?php
require_once("Person.php");

class SuperHero extends Person {
    private $hasCape;
    private $health;
    private $isDead;
    
    /**
     * @return number
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param number $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function __construct($newName, $health) {
        $this->name = $newName;
        $this->health = $health;
        $this->isDead = false;
    }
    
    public function isHeDead() {
        if ($this->isDead) {
            return "dead";
        }
        else {
            return "alive";
        }
    }
    
    public function isDead() {
        return $this->isDead;
    }
    
    public function DetermineHealth($hitAgainstMe) {
        $this->health = $this->health - $hitAgainstMe;
        if ($this->health <= 0) {
            $this->isDead = true;
        }
    }
    
    public function Attack(SuperHero $enemy) {
        // pick random from 1 to 10
        // subtract that value from the enemy.
        $damage = rand(1,10);
        $enemy->DetermineHealth($damage);
        echo $this->name . " has attacked " . $enemy->name . " and caused " . $damage . " hit points against him.<br>";
    }
    
    public function obtainACape() {
        $this->hasCape = true;
    }
    
    public function loseCape() {
        $this->hasCape = false;
    }
    
    public function capeStatus() {
        if ($this->hasCape = true) {
            echo $this->name . " has a cape.<br>";
        } else {
            echo $this->name . " does not have a cape.<br>";
        }
    }
}

?>