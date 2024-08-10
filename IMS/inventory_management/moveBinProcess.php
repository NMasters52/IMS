<?php
session_start();
include "../db.php";

$bin = $_POST["bin"];
$pallet_id = $_POST["pallet_id"];

$sql = "UPDATE inventory_received SET bin ='$bin' WHERE pallet_id='$pallet_id'";


if (mysqli_query($conn, $sql)) {
    $_SESSION['message'] = "binMoved";
    header('Location: materialManagementDashboardPage.php');
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
  
  mysqli_close($conn);


?>