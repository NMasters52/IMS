<?php
session_start();
include "../db.php";

// Collect form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$userPassword = $_POST['userPassword']; // Plain-text password from the form
$encrypted = password_hash($userPassword, PASSWORD_DEFAULT); // Hash the password

// Prepare SQL query (using prepared statement for security)
$sql = "INSERT INTO users_IMS (firstName, lastName, email, userPassword) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters and execute query
mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $encrypted);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['message'] = 'useradded';
  header("Location: addUser.php");
} else {
  echo "Error: " . mysqli_stmt_error($stmt);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
