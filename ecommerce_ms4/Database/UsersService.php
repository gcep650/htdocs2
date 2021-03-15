<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Users Service Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class with functions related to access to users,
 * such as getting users and creating users.
 */
require_once("Customer.php");
require_once("DBConnection.php");
require_once('../Logic/db_funcs.php');

class UsersService {
    function getAllUsers() {
        $db = new DBConnection();
        
        $con = $db->getCon();
        
        $query = "SELECT ID FROM users";
        
        $run = $con->prepare($query);
        
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $users = array();
            while ($row = $result->fetch_assoc()) {
                $users[] = new Customer($row['ID']);
            }
            return $users;
        }
        return null;
    }
    
    // returns a new customer object with the specified ID
    function getUserById(int $id) {
        return new Customer($id);
    }
    
    // creates a new user with the input given
    // returns true if user was created successfully
    function createUser($first,$last,$email,$phone,$username,$password) {
        // check that no fields are blank
        if(no_blanks($first,$last,$email,$phone,$username,$password)) {
            $db = new DBConnection();
            
            $con = $db->getCon();
            
            // begin SQL statement to check if username is taken
            $query = "SELECT * FROM users WHERE username=?";
            $run = $con->prepare($query);
            $run->bind_param('s',$username);
            $run->execute();
            $result = $run->get_result();
            
            // if true, username is not taken so insert into table
            if ($result->num_rows == 0) {
                
                // begin SQL statement to insert information into users table
                $query = "INSERT INTO users (first_name, last_name, email, phone, username, password) VALUES (?,?,?,?,?,?)";
                $query2 = "INSERT INTO roles (USER_ID, IS_ADMIN) VALUES (LAST_INSERT_ID(), 0);";
                $run = $con->prepare($query);
                $run2 = $con->prepare($query2);
                $run->bind_param('ssssss',$first,$last,$email,$phone,$username,$password);
                $run->execute();
                $run2->execute();
                
                
                
                // if true, row was successfully created
                if ($run->affected_rows > 0 && $run2->affected_rows > 0) {
                    return true;
                }
                
            } else {
                return false;
            }
            
        } else {
            return false;
        }
    }
}