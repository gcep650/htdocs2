<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.1
 * Module name: Registration Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module interprets user input and registers the user into the system if the information is correct.
 * This module will be updated in the future to use a class rather than just functions.
 */
require_once('db_funcs.php');

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

// get information from registration page
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

// check that no fields are blank
if(no_blanks($first,$last,$email,$phone,$username,$password)) {
    $con = db_con();
    
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
            echo "User registered successfully!<br>";
            echo "<a href='../Presentation/login.html'><button>Go to Login Page</button></a>";
        }
        
    } else {
        echo "A user is already registered with that username. Please try again with a different username.<br>";
        echo "<a href='../Presentation/register.html'><button>Back</button></a>";
    }
    
} else {
    echo "You cannot leave any of the fields blank. Register failed.<br>";
    echo "<a href='../Presentation/register.html'><button>Back</button></a>";
}


?>