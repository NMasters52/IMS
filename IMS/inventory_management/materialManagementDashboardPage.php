<?php
session_start(); //Start Sessions
include "../db.php"; //Database Credentials 


if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] === "loggedin") {
        echo '<div class="alert-success">Welcome to the dashboard!</div>';
    }  else if ($_SESSION['message'] === "useradded") {
        echo '<div class="alert-success">User Was added succesfully</div>';
    }  else if ($_SESSION['message'] === "pallet_dispatched") {
        echo '<div class="alert-success">Pallet was dispatched succesfully.</div>';
    } else if ($_SESSION['message'] === "binMoved") {
        echo '<div class="alert-success">Bin was moved succesfully.</div>';
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


                        <!-- if edit user button is used, this will be the form on the screen. -->
                            <?php
                                    if(isset($_POST['moveBinProcess'])){
                                ?>

                                <div class="moveBinContainer">  
                                    <div class="moveBinForm">
                                        <h2 class="materialManagmentHeader">Move Bin Location Form </h1>

                                        
                                            <div class="editLabelContainer">
                                                <form action="moveBinProcess.php" method="POST">
                                                    <!-- grabing pallet info by palletId hidden input -->
                                                <input type="hidden" name="pallet_id" value="<?=$_POST['pallet_id']?>">
                                                <label>
                                                    <input type="text" name="bin" value="<?=$_POST["bin"]?>" required>
                                                </label>

                                                <button type="submit" name="moveBinProcess" class="moveBinProcess">Move Bin</button>
                                            </div>
                                            
                                        </form>


                                        <!-- table of where the bin is located currently and the pallet id so they can have a refrence -->
                                         <h3 class="materialManagmentHeader">Current Bin Location</h3>
                                         <div class="editBinLocationTable">
                                            <table>
                                                <thead>
                                                    <th>Bin Location</th>
                                                    <th>Pallet ID</th>
                                                </thead>  
                                                <tbody>
                                                    <tr>
                                                        <td><?=$_POST["bin"]?></td>
                                                        <td><?=$_POST["pallet_id"]?></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                         </div>
                                        

                                    </div>
                                </div>
                                        

                            

                            

                                <!-- else display the rest of the page as normal -->
                                <?php
                                } else {
                                ?>
                        <!-- main div container -->
                        <div class="materialManagementMainContainer ">

                            <div class="materialManagementFormContainer">

                                <table>

                                    <thead>
                                        <th>Bin Location</th>
                                        <th>Pallet Size</th>
                                        <th>Pallet ID</th>
                                        <th>Receive Date</th>
                                        <th>Type of Material</th>
                                        <th>Dispatch Material</th>
                                        <th>Move Bin</th>
                                    </thead>

                                    <tbody>
                                        

                                            <!-- PHP TO LOOP SELECTED DATA FOR TABLE -->
                                            <?php
                                            $sql = "SELECT * FROM inventory_received";
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
                                                <!-- dispatch/move bin button have td lower -->


                                                <!-- dispatch button -->
                                                <td>

                                                    <form action="dispatchProcess.php" method="POST">
                                                        <input type="hidden" name="bin" value="<?=$row["bin"]?>">
                                                        <input type="hidden" name="pallet_size" value="<?=$row["pallet_size"]?>">
                                                        <input type="hidden" name="pallet_id" value="<?=$row["pallet_id"]?>">
                                                        <input type="hidden" name="receive_date" value="<?=$row["receive_date"]?>">
                                                        <input type="hidden" name="material" value="<?=$row["material"]?>">
                                                        <button type="submit" name="dispatchProcess" class="materialManagmentButton">Dispatch</button>
                                                    </form>
                                                
                                                </td>

                                                
                                                <!-- move bin button -->
                                                <td>

                                                    <form action="materialManagementDashboardPage.php" method="POST">
                                                        <input type="hidden" name="pallet_id" value="<?=$row['pallet_id']?>">
                                                        <input type="hidden" name="bin" value="<?=$row["bin"]?>">
                                                        <button type="submit" name="moveBinProcess" class="materialManagmentButton">Move Bin</button>
                                                    </form>

                                            </td>

                                                
                                            </tr>

                                                    <!-- END OF TABLE LOOP -->
                                                    <?php
                                                    }
                                                    } else {
                                                    echo "0 results";
                                                    }

                                                    mysqli_close($conn);
                                                    ?>
                                    </tbody>



                                </table>


                     <!-- finishes the else statement form the moveBin form -->
                        <?php
                        }
                        ?>

                    </div>

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