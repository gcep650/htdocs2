<?php

class SecurityService {
    
    private $username;
    private $password;
    
    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
    
    function login($username, $password) {
        return $username == $this->username && $password == $this->password;
    }
    
}