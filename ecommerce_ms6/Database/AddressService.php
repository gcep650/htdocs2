<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.4
 * Module name: AddressService Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class that contains functions related to addresses.
 */
require_once("../Database/DBConnection.php");
require_once("../Database/Address.php");

class AddressService {
    private $conn;
    
    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getCon();
    }
    
    // return array of addresses from given user id
    public function getAddressesFromUser($id) {
        $query = "SELECT * FROM addresses WHERE USER_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $id);
        $run->execute();
        
        $result = $run->get_result();
        
        $addresses = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
            {
                array_push($addresses, new Address($row['ADDRESS_ID']));
            }
        }
        
        return $addresses;
    }
    
    // creates a new address given the appropriate information
    public function createAddress($user_id,$street,$city,$state,$zip) {
        $query = "INSERT INTO addresses (USER_ID,STREET,CITY,STATE,ZIP) VALUES (?,?,?,?,?)";
        $run = $this->conn->prepare($query);
        $run->bind_param('isssi', $user_id,$street,$city,$state,$zip);
        $run->execute();
        
        return $run->affected_rows;
    }
}