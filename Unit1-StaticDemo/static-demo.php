<?php

require_once("User.php");

$pw = 'asdf';
$pw2 = 'iuowrhew';

if(User::validatePassword($pw2)) {
    echo "Password is long enough!<br>";
} else {
    echo "Password is not long enough.<br>";
}

?>