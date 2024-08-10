<?php
session_start(); // Start the session
include "../db.php"; // Database credentials

// Check if the user is logged in
if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] === "loggedin") {
        echo '<div class="alert-success">Welcome to the dashboard!</div>';
    } else {
// If not logged in, redirect to the login page
header('Location: ../login/logIn.php');
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
            include "dashboardSideBarTemplate.php";
         ?>

         <!-- dashbaord content main container and top nav bar -->
        <div class="dashboard_content_container" id="dashboard_content_container">

            <!-- top nav bar -->
            <?php include "dashboardTopNavTemplate.php"; ?>

            <!-- main content on page -->
            <div class="dashboard_content">

                <div class="dashboard_content_main">

                    <div class="pageContainerEmployeeDB">
                        <div class="employeeDBContainerColor">

                            <h1 class="employeeDashboardHeader">Employee Dashboard</h1>

                    

                <!-- Div container for employee pic and info -->
                <div class="employeeDBContainer">
                    

                        <!-- Picture of employee -->
                        <div class="employeePicContiner">

                            <img class="employeePic" src="../images/employeeee.jpg" alt="Picture of Warehouse Employee">

                        </div>

                        <!-- info of employee -->
                        <div class="employeeInfoContainer">
                            <div class="ulInfoContainer">
                                
                                    <ul>
                                        <h3 class="employeeInfoHeader">Employee Information</h3>
                                        <li>Name: Jane Doe</li>
                                        <li>Position: Warehouse Manager</li>
                                        <li>Time Employed: 2 Years</li>
                                        <li>About: Lorem ipsum dolor, sit amet consectetur adipisicing elit. </li>

                                    </ul>
                            </div>
                        </div>
                     </div>

                   
            

                    

                        <!-- news for company/website -->
                        
                        <h2 class="carouselInfoHeader">Company News</h2>
                                <div class="carousel" data-carousel>
                                    <button class="carousel-button prev" data-carousel-button ="prev"><i class="fa-solid fa-backward"></i></button>
                                        <div class="carouselPicContainer">
                                            <ul data-slides>
                                                <li class="slide" data-active>
                                                    <img src="../images/newsOne.jpg" alt="">
                                                </li>
                                                <li class="slide">
                                                    <img src="../images/newsTwoTwo.jpg" alt="">
                                                </li>
                                                <li class="slide"> 
                                                    <img src="../images/newsThree.jpg" alt="">
                                                </li>
                                            </ul>
                                        </div>
                                    <button class="carousel-button next" data-carousel-button="next"><i class="fa-solid fa-forward"></i></button>
                                </div>
                           
                        



                        </div>
                    </div>  
                </div>
            </div> 
        </div>
    </div>
</body>
<!-- js for dashbaord connection -->
<script src="dashboard.js"></script>
<!-- font awsome connection -->
<script src="https://kit.fontawesome.com/ec3dee1045.js" crossorigin="anonymous"></script>

</html>