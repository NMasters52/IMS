<?php
session_start();
include "../db.php";

// Retrieve form values
$bin = $_POST["bin"];
$pallet_size = $_POST["pallet_size"];
$pallet_id = $_POST["pallet_id"];
$receive_date = $_POST["receive_date"];
$material = $_POST["material"];

// Prepare the SQL query
$sql = "INSERT INTO inventory_received (bin, pallet_size, pallet_id, receive_date, material)
        VALUES ('$bin', '$pallet_size', '$pallet_id', '$receive_date', '$material')";                                           

// Execute the query
if (mysqli_query($conn, $sql)) {
  $_SESSION['message'] = "pallet_received";
    header("Location: receiveGoodsDashboardPage.php");
} else {
    // Output the SQL query and error message if there is a failure
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
