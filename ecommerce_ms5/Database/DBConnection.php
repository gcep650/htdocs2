<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: DBConnection Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class with functions related to database connection.
 */
class DBConnection {
    
    // create class variables for database connection
    private $host;
    private $username;
    private $password;
    private $dbname;
    
    // no arguments. sets variables to project-specific values
    function __construct() {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = 'root';
        $this->dbname = 'ecommerce_db';
    }
    
    // attempts to get a connection to the database using the class variables.
    // returns null if connection failed.
    function getCon() {
        $db = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        if (!$db->connect_error) {
            return $db;
        }
        return null;
    }
    
}

?>