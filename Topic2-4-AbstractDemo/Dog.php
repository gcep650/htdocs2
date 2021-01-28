<?php

require_once("Animal.php");

class Dog extends Animal
{
    
    public function talk()
    {
        echo "Bark bark.<br>";
    }
    public function doTrick()
    {
        echo "Jumps. Fetches. Good catch!<br>";
    }


}

