<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Customer Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class with functions related to a registered user.
 */
require_once("../Database/DBConnection.php");
//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);
class Customer {
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $username;
    private $password;
    private $is_admin;
    
    private $db;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function isAdmin() {
        return $this->is_admin == 1;
    }
    
    // returns roles. currently only returns string representing admin or member
    public function getRoles() {
        if ($this->isAdmin()) {
            return "Administrator";
        }
        else {
            return "Member";
        }
    }
    
    // deletes the current customer from the system.
    public function deleteUser() {
        $con = $this->db->getCon();
        $query = "DELETE FROM users WHERE ID=?";
        $run = $con->prepare($query);
        $run->bind_param("i", $this->id);
        $run->execute();
        
        return $run->affected_rows > 0;
    }

    // constructor to initialize Customer object
    function __construct(int $user_id) {
        $this->db = new DBConnection();
        $this->id = $user_id;
        $this->updateValues();
    }
    
    // function that updates the member variables from the database.
    // always called in constructor to ensure class is holding current values
    // replaces information inside class with current information FROM database
    function updateValues() {
        $test = new DBConnection();
        $con = $test->getCon();
        $query = "SELECT users.*, roles.IS_ADMIN FROM users INNER JOIN roles ON users.ID = roles.USER_ID WHERE users.ID=?;";

        $run = $con->prepare($query);
        $run->bind_param("i", $this->id);
        $run->execute();
        
        $result = $run->get_result();

        if ($result->num_rows == 1) {
            
            $info = $result->fetch_assoc();
            
            $this->first_name = $info["first_name"];
            $this->last_name = $info["last_name"];
            $this->email = $info["email"];
            $this->phone = $info['phone'];
            $this->username = $info["username"];
            $this->password = $info['password'];
            $this->is_admin = $info["IS_ADMIN"];
        }
    }
    
    // function that takes the variables from the current class and inserts them into the
    // corresponding row for the user into the database
    // replaces information from database with the variables inside current class
    function setValues() {
        $con = $this->db->getCon();
        $query = "UPDATE users SET FIRST_NAME=?, LAST_NAME=?, EMAIL=?, PHONE=?, USERNAME=?, PASSWORD=? WHERE ID=?";
        $run = $con->prepare($query);
        $run->bind_param("ssssssi", $this->first_name,$this->last_name,$this->email,$this->phone,$this->username,$this->password,$this->id);
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    
    
    
}