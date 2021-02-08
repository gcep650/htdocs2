<?php

require_once("UserDataService.php");

class UserBusinessService {
    
    function searchByFirstName($pattern) {
        
        $persons = array();
        
        $dbService = new UserDataService();
        $persons = $dbService->findByFirstName($pattern);
        
        return $persons; 
    }
    
    function searchByLastName($pattern) {
        $persons = array();
        
        $dbService = new UserDataService();
        $persons = $dbService->findByLastName($pattern);
        
        return $persons;
    }
    
}