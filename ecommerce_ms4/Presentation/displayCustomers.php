<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Display Users Module
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module displays a list of users given as an array of Customer objects
 */
// start creating table
require_once("../Database/Customer.php");
session_start();
echo "<table>";
$admin = 0;
if (isset($_SESSION['user'])) {
    $admin = $_SESSION['user']->getAdmin();
}
// iterate through users array
for ($i = 0; $i < count($users); $i++) {
    // create table headers
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>E-Mail Address</th><th>Phone Number</th><th>Username</th><th>Password</th><th>Role</th><th colspan='3'>Actions</th></tr>";
    echo "<tr>";
    // get customer object
    $c = $users[$i];
    //$c = new Customer();
    echo "<td>" . $c->getId() . "</td>" . "<td>" . $c->getFirstName() . "</td>" .
        "<td>" . $c->getLastName() . "</td>" . "<td>" . $c->getEmail() . "</td>" .
        "<td>" . $c->getPhone() . "</td>" . "<td>" . $c->getUsername() . "</td>" .
        "<td>" . $c->getPassword() . "</td>" . "<td>" . $c->getRoles() . "</td>";
    // print View Product button
    echo "<td><a href='../Presentation/user.php?id=" . $c->getId() . "'><button name='view' type='submit' value='view'>View User</button></a></td>";
    if ($admin == 1) {
        echo '<form action="../Logic/deleteUser.php" method="post">';
        echo '<td><button name="delete" type="submit" value=' . $c->getId() . '>Delete User</button></td></form>';
        echo '<form action="../Presentation/editUser.php" method="post">';
        echo '<td><button name="edit" type="submit" value=' . $c->getId() . '>Edit User</button></td></form>';
    }
    echo "</tr>";
}
echo "</table>";