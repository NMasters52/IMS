<?php
    session_start(); //Start Sessions
    include "../db.php"; //Database Credentials 

$firstName = $_POST['firstName'];

    // sql to delete a record
$sql = "DELETE FROM users_IMS WHERE firstName = '{$_POST['firstName']}' ";


if ($conn->query($sql) === TRUE) {
  $_SESSION['message'] = "userDeleted";
} else {
  echo "Error deleting record: " . $conn->error;
}

header("Location: ./usersTable.php");

$conn->close();

?>