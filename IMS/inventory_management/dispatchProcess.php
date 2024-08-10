<?php
session_start(); 
include "../db.php"; 

$bin = $_POST["bin"];
$pallet_size = $_POST["pallet_size"];
$pallet_id = $_POST["pallet_id"];
$receive_date = $_POST["receive_date"];
$material = $_POST["material"];
$dispatch_date = date('Y-m-d');

// Prepare the INSERT INTO statement
$insert_sql = "INSERT INTO inventory_dispatched (bin, pallet_size, pallet_id, dispatch_date, material) 
               SELECT bin, pallet_size, pallet_id, '$dispatch_date', material 
               FROM inventory_received 
               WHERE bin = '$bin'";  // Add a WHERE clause to ensure only relevant records are copied


if (mysqli_query($conn, $insert_sql)) {
    // Prepare the DELETE FROM statement
    $delete_sql = "DELETE FROM inventory_received WHERE bin = '$bin'";

    // Execute the DELETE FROM statement
    if (mysqli_query($conn, $delete_sql)) {
      $_SESSION['message'] = "pallet_dispatched";
        header("Location: materialManagementDashboardPage.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
