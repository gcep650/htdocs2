<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.4
 * Module name: Address Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module contains a class that stores information on an Addresss from the database.
 */
require_once("../Database/DBConnection.php");
class Address {
    private $address_id;
    private $user_id;
    private $street;
    private $city;
    private $state;
    private $zip;
    private $conn;
    
    // create new address object. $id = id of address row in database table
    public function __construct($id) {
        $db = new DBConnection();
        $this->conn = $db->getCon();
        $this->address_id = $id;
        
        $this->updateValues();
        
    }
    
    // get values from the database and set the member variables of the current instance
    public function updateValues() {
        $query = "SELECT * FROM addresses WHERE ADDRESS_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $this->address_id);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            
            $this->user_id = $info['USER_ID'];
            $this->street = $info['STREET'];
            $this->city = $info['CITY'];
            $this->state = $info['STATE'];
            $this->zip = $info['ZIP'];
        }
        else {
            throw new Exception("Address was not found.");
        }
    }
    
    // updates the database row and replaces the database information with the variable data stored in the current instance
    public function setValues() {
        $query = "UPDATE addresses SET USER_ID=?, STREET=?, CITY=?, STATE=?, ZIP=? WHERE ADDRESS_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param("isssii", $this->first_name,$this->last_name,$this->email,$this->phone,$this->username,$this->password,$this->id);
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    /**
     * @return mixed
     */
    public function getAddress_id()
    {
        return $this->address_id;
    }

    /**
     * @return mixed
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $user_id
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    
    
}