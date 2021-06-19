<?php
session_start();
date_default_timezone_set('Africa/Algiers');

$servername = "localhost";
$username = "root";
$password = "rahimo#1";
// Create connection
$connection = new mysqli($servername, $username, $password,'ubiclinic');

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
require_once('function.php');
?>

