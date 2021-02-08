<?php

ini_set('display_errors', 1);
ini_set('error_reporting', -1);

require_once('UserDataService.php');

$u = new UserDataService();

//echo "<pre>" . print_r($u->findByFirstName('Mark'), TRUE) . "</pre>";

echo json_encode($u->findByFirstName('Mark'));

echo json_encode($u->findByLastName('Wilson'));
