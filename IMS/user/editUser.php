<?php
session_start();
include '../db.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$id = $_POST['id'];

$sql = "UPDATE users_IMS SET firstName = '$firstName', lastName = '$lastName', email = '$email' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
  $_SESSION['message'] = "userEdited";
  header('Location: usersTable.php');
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>