<?php

class Person
{
    public $age;
    
    final public function growOlderBy($year) {
        $this->age = $this->age + $year;
    }
}

