<?php
session_start(); //Start Sessions
include "../db.php"; //Database Credentials 


if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] === "loggedin") {
        echo '<div class="alert-success">Welcome to the dashboard!</div>';
    }  else if ($_SESSION['message'] === "useradded") {
        echo '<div class="alert-success">User Was added succesfully</div>';
    } else if ($_SESSION['message'] === "pallet_received") {
        echo '<div class="alert-success">Pallet was received succesfully.</div>';
    } else {
// If not logged in, redirect to the login page
header('Location: ../login/logOut.php');
exit;
}
unset($_SESSION['message']); // Remove the message after displaying it
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory Managment System</title>
    <!-- css sheet link -->
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <!-- main div for page -->
    <div id="dashboard_main_container">

        <!-- Sidebar Nav -->
         <?php
            include "../dashboard/dashboardSideBarTemplate.php";
         ?>

         <!-- dashbaord content main container-->
        <div class="dashboard_content_container" id="dashboard_content_container">

            <!-- top nav bar -->
            <?php include "../dashboard/dashboardTopNavTemplate.php"; ?>

            <!-- main content on page -->
            <div class="dashboard_content">
                <div class="dashboard_content_main">

                <!-- END OF TEMPLATE FOR DASHBAORD. PAST HERE IS CODE SPECIFIC TO THE PAGE -->

                <!-- RECIVING GOODS FORM -->


                <!-- main div container -->
                <div class="receiveMainContainer">

                    <div class="formContainer">

                        <form action="receiveProcess.php" method="POST" class="receiveForm">

                        <div class="palletHeader">
                            <h3>Pallet Receiver Form</h3>
                        </div>

                        <div class="form-group">
                             <label for="bin">Bin Location<input type="text" name="bin" required></label>
                        </div>

                        <div class="form-group">
                            <label for="pallet_size">Amount on pallet<input type="text" name="pallet_size" required></label>
                        </div>

                        <div class="form-group">
                            <label for="pallet_id">Pallet ID<input type="text" name="pallet_id" required></label>
                        </div>

                        <div class="form-group">
                            <label for="receive_date">Date Received<input type="date" name="receive_date" required></label>
                        </div>

                        <div class="form-group">
                            <label for="material">Type Of Material</label>
                            <select name="material" id="material">

                                <option>"Tile"</option>
                                <option>"Wood"</option>
                                <option>"Carpet"</option>
                                <option>"Setting Material"</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <button class="receiveGoodsButton" type="submit" name="receiveGoods">Receive Pallet</button>
                        </div>

                        </form>

                    </div>

                </div>   


                <div class="recieveLastTenContainer">

                    <table class="receiversTable">

                    <h3 class="receiveTableHeader">Last 10 Pallets Recieved</h3>

                        <thead>
                            <th>Bin Location</th>
                            <th>Pallet Size</th>
                            <th>Pallet ID</th>
                            <th>Receive Date</th>
                            <th>Type of Material</th>
                        </thead>

                        <tbody>

                        <?php
                                        $sql = "SELECT * FROM inventory_received ORDER BY receive_date DESC LIMIT 10";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                        <tr>
                                            <td><?=$row["bin"]?></td>
                                            <td><?=$row["pallet_size"]?></td>
                                            <td><?=$row["pallet_id"]?></td>
                                            <td><?=$row["receive_date"]?></td>
                                            <td><?=$row["material"]?></td>
                                        </tr>
                                        <?php
                                                }
                                                } else {
                                                echo "0 results";
                                                }

                                                mysqli_close($conn);
                                                ?>

                        </tbody>

                    </table>

                </div>
                    



                </div>
            </div> 

        </div>
    </div>
</body>

<!-- js for dashbaord connection -->
<script src="../dashboard/dashboard.js"></script>
<!-- font awsome connection -->
<script src="https://kit.fontawesome.com/ec3dee1045.js" crossorigin="anonymous"></script>

</html>