<?php
require_once('db_funcs.php');

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
        $run = $con->prepare($query);
        $run->bind_param('ssssss',$first,$last,$email,$phone,$username,$password);
        $run->execute();
        
        // if true, row was successfully created
        if ($run->affected_rows > 0) {
            echo "User registered successfully!<br>";
            echo "<a href='login.html'><button>Go to Login Page</button></a>";
        }
        
    } else {
        echo "A user is already registered with that username. Please try again with a different username.<br>";
        echo "<a href='register.html'><button>Back</button></a>";
    }
    
} else {
    echo "You cannot leave any of the fields blank. Register failed.<br>";
    echo "<a href='register.html'><button>Back</button></a>";
}


?>