<?php

require_once('Database.php');

class UserDataService {
    
    function findByFirstName($n) {
        $db = new Database();
        
        //echo "Testing db<br>";
        //print_r($db);
        
        //echo "<br>I am searching for " . $n . "<br>";
        
        $query = "SELECT * FROM users WHERE FIRST_NAME LIKE '%$n%'";
        
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM users WHERE FIRST_NAME LIKE ?");
        
        $like_n = "%" . $n . "%";
        $stmt->bind_param('s',$like_n);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if (!$result) {
            echo "An error occured. This may be an issue with the SQL statement.<br>";
            exit;
        }
        
        if ($result->num_rows == 0) {
            return null;
        }
        else {
            //echo "I found " . $result->num_rows . " results.<br>";
            
            $person_array = array();
            
            while ($person = $result->fetch_assoc()) {
                //print_r($person);
                //echo "<br>";
                //echo "Person ID = " . $person['ID'] . " FIRST_NAME = " . $person['FIRST_NAME'] . " LAST_NAME = " . $person['LAST_NAME'] . "<br>";
                
                array_push($person_array, $person);
            }
            
            return $person_array;
        }
    }
    
    function findByLastName($n) {
        $db = new Database();
        
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM users WHERE LAST_NAME LIKE ?");
        
        $like_n = "%" . $n . "%";
        $stmt->bind_param('s',$like_n);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if (!$result) {
            echo "An error occured. This may be an issue with the SQL statement.<br>";
            exit;
        }
        
        if ($result->num_rows == 0) {
            return null;
        }
        else {
            
            $person_array = array();
            
            while ($person = $result->fetch_assoc()) {
                array_push($person_array, $person);
            }
            
            return $person_array;
        }
    }
    
}