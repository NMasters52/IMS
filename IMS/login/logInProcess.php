<?php
session_start();
include "../db.php";

$email = $_POST['email'];
$userPassword = $_POST['userPassword']; // Plain-text password entered by user

// Retrieve first name and hashed password from database
$sql = "SELECT userPassword, firstName FROM users_IMS WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $hashedPassword, $firstName);

if (mysqli_stmt_fetch($stmt)) {
    // Verify the entered password with the hashed password from database
    if (password_verify($userPassword, $hashedPassword)) {
      $_SESSION['message'] = 'loggedin';
      $_SESSION['firstName'] = $firstName;
      header("Location: ../dashboard/dashboard.php");
      exit;
  }  else {
    $_SESSION['message'] = 'loginfailed';
    header("Location: logIn.php");
    exit;
}
  
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
