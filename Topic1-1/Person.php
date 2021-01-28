<?php

class Person
{
    private $name;
    private $username;
    private $password;
    
    public function __construct($newName)
    {
            echo "Hello, my name is " . $newName . "<br>";
            $this->name = $newName;
            $this->username = "bob";
            $this->password = "qwerty";
    }
    
    public function walk() {
        echo $this->name . " is walking...<br>";
    }
    
    public function greeting() {
        echo "Hello.<br>";
    }
    
    public function formalGreeting() {
        echo "Good day to you sir. You can address me as " . $this->name . "<br>";
    }
    
    public function spanishGreeting() {
        echo "Hola. Me llamo " . $this->name . "<br>";
    }
    
    public function login($username, $password) {
        if ($username == $this->username && $password == $this->password) {
            echo "You are now logged in";
        }
        else {
            echo "Your username or password is incorrect.<br>";
        }
    }
}

