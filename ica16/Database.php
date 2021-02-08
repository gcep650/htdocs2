<?php
class Database {
    
    private $dbservername = 'localhost';
    private $dbusername = 'root';
    private $dbpass = 'root';
    private $dbname = "ica17";
    
    function getConnection() {
        $dbcon = new mysqli($this->dbservername, $this->dbusername, $this->dbpass, $this->dbname);
        
        if ($dbcon->connect_error) {
            echo "Connection to the database failed.<br> Error: " . $dbcon->connect_error . "<br>";            
        }
        else {
            return $dbcon;
        }
    }
}