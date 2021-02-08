<?php
//require_once("SecurityService.php");
require_once("Autoloader.php");
include('header.php');

$username = $_POST['username'];
$password = $_POST['password'];

if ($username != "" && $password != "") {
    $service = new SecurityService('admin', 'qwerty1234');
    
    if ($service->login($username, $password)) {
        $_SESSION['principle'] = true;
        include("loginPassed.php");
    }
    else {
        $_SESSION['principle'] = false;
        include("loginFailed.php");
    }
}
else {
    echo "You cannot leave any of the fields blank.<br>";
}