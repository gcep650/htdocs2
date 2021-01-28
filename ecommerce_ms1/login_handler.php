<?php

session_start();

require_once('db_funcs.php');

// get information from login page
$username = $_POST['username'];
$password = $_POST['password'];

// check that all fields are filled
if (no_blanks($username,$password)) {
    $con = db_con();
    
    // begin SQL query to check username and password
    $query = "SELECT * FROM users WHERE username=? AND password=?";
    $run = $con->prepare($query);
    $run->bind_param("ss",$username,$password);
    $run->execute();
    
    $result = $run->get_result();
    
    // if true, username and password match a record
    if ($result->num_rows == 1) {
        echo "Successfully logged in!<br>";
        $info = $result->fetch_assoc();
        
        // set the session id and name
        set_id($info['ID']);
        set_name($info['first_name'],$info['last_name']);
        
        include_once('main.php');
    }
    else {
        echo "Login failed. The username and/or password is incorrect.<br>";
        echo "<a href='login.html'><button>Back</button></a>";
    }
} else {
    echo "You cannot leave any of the fields blank. Login failed.<br>";
    echo "<a href='login.html'><button>Back</button></a>";
}



?>