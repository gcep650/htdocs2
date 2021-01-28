<html>
<head>
<style>
div {
text-align: center;
</style>
</head>
<div>
<?php

session_start();

require_once('db_funcs.php');

// check if session variables 'id' and 'name' are set from login
// if true, user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
    echo "<h1>Welcome!</h1><br>";
    echo "<h4>You are logged in as: " . get_name() . "</h4><br>";
    echo "ID: " . get_id() . "<br>";
    echo "<a href='logoff.php'><button>Logoff</button></a>";
} else {
    echo "Error: User is not logged in. Access denied.<br>";
    echo "<a href='index.html'><button>Back</button></a>";
}

?>
</div>
</html>