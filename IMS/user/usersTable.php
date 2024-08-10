<?php
session_start(); //Start Sessions
include "../db.php"; //Database Credentials 


//change this user added/deleted/or edited
if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] === "loggedin") {
        echo '<div class="alert-success">Welcome to the dashboard!</div>';
    }  else if ($_SESSION['message'] === "useradded") {
        echo '<div class="alert-success">User Was added succesfully</div>';
    } else if ($_SESSION['message'] === "userDeleted") {
        echo '<div class="alert-success">User Was deleted succesfully</div>';
    } else if ($_SESSION['message'] === "userEdited") {
        echo '<div class="alert-success">User Was edited succesfully</div>';
    } else {
// If not logged in, redirect to the login page
header('Location: ../login/logOut.php');
exit;
}
unset($_SESSION['message']); // Remove the message after displaying it
    } ?>

    


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

                <!-- if edit user button is used, this will be the form on the screen. -->
                <?php
                 if(isset($_POST['editUser'])){
                ?>

    
        <div class="editUserContainer">
            <div class="editUserForm">
                <form action="editUser.php" method="POST">
                    <h2 class="editUserH2">Edit User</h2>

                    <!-- targeting by id -->
                    <input type="hidden" name="id" value="<?=$_POST['id']?>"> 

                    <div class="editLabelContainer">
                        <Label class="editLabel">First Name
                            <input type="text" name="firstName" value="<?=$_POST['firstName']?>" required>
                        </Label>
                    </div>

                    <div class="editLabelContainer">
                        <Label class="editLabel"> Last Name
                            <input type="text" name="lastName" value="<?=$_POST['lastName']?>" required>
                        </Label>
                    </div>

                    <div class="editLabelContainer">
                        <Label class="editLabel"> Email
                            <input type="text" name="email" value="<?=$_POST['email']?>" required>
                        </Label>
                    </div>

                    <button type="submit" name="editUser" class="editButton">
                    <i class="fa-solid fa-user-pen"></i> Edit User 
                    </button>
                </form> 
            </div>
        </div>
          

<?php
    } else {
?>

                        <!--table to show users -->
                    
                    <div class="usersTableContainer">

                    <h2 class="tableHeader">Current Users in Database</h2>
                        <table class="usersTable">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Delete User</th>
                                        <th>Edit User</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $sql = "SELECT id,firstName, lastName, email FROM users_IMS";
                                        $result = mysqli_query($conn, $sql);
                                        
                                        if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                    <tr>
                                        <td><?=$row['firstName']?></td>
                                        <td><?=$row['lastName']?></td>
                                        <td><?=$row['email']?></td>

                                        <!-- delete button on the table -->
                                        <td>

                                            <form action="deleteUser.php" method="POST">
                                                <input type="hidden" name="firstName" value="<?=$row['firstName']?>">
                                                <button type="submit" name="deleteUser"><i class="fa-solid fa-user-slash userButton"></i></button>
                                            </form>

                                        </td>

                                        <!-- edit user button-->
                                        <td>
                                            <form action="usersTable.php" method ="POST">
                                            <input type="hidden" name="id" value="<?=$row['id']?>">
                                            <input type="hidden" name="firstName" value="<?= $row['firstName']?>">
                                            <input type="hidden" name="lastName" value="<?= $row['lastName']?>">
                                            <input type="hidden" name="email" value="<?= $row['email']?>">
                                                <button type="submit" name="editUser"><i class="fa-solid fa-user-pen userButton"></i></button>
                                            </form>
                                        </td>

                                    </tr>

                                    <!-- end of loops -->
                                    <?php
                                        }
                                    } else {
                                    echo "0 results";
                                    }
                                    mysqli_close($conn);
                                    ?>

                                </tbody>
                        </table>
                        <!-- end of div for table -->
                   </div>
                </div>
            </div> 

        </div>
    </div>

    <!-- finishes the else statement form the edit form -->
    <?php
    }
    ?>

</body>

<!-- js for dashbaord connection -->
<script src="../dashboard/dashboard.js"></script>
<!-- font awsome connection -->
<script src="https://kit.fontawesome.com/ec3dee1045.js" crossorigin="anonymous"></script>

</html>