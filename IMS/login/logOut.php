<?php
session_start(); //start the session
session_unset(); //end the session

session_destroy(); //take away session memort
header('location: logIn.php'); //take user out of the dashboard
?>