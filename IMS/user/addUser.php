<?php
session_start(); //Start Sessions
include "../db.php"; //Database Credentials 


if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] === "loggedin") {
        echo '<div class="alert-success">Welcome to the dashboard!</div>';
    }  else if ($_SESSION['message'] === "useradded") {
        echo '<div class="alert-success">User Was added succesfully</div>';
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

                    <!-- Add user form -->
                     <div class="mainFormContainer">

                        <form action="addUserProcess.php" class="addUserForm" method="POST">
                                <h2 class="addUserFormHeader">Add User Form</h2>
                                <div class="divFormContainer">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" name="firstName"class="addUserInput" required>
                                </div>
                                <div class="divFormContainer">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" class="addUserInput" required>
                                </div>
                                <div class="divFormContainer">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"class="addUserInput"required>
                                </div>
                                <div class="divFormContainer">
                                    <label for="userPassword">Password</label>
                                    <input type="password" id="userPassword" name="userPassword"class="addUserInput" required>
                                </div>
                                <button class="addUserButton" type="submit"><i class="fa-solid fa-user-plus"></i> Add User</button>
                        </form>

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