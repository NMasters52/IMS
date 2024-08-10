<?php
session_start();
$servername = "localhost";
$username = "nmasters";
$password = "kneTe6EtaU2MFpR4";
$dbname = "nmasters";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  ?> 