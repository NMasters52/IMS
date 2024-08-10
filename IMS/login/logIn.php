<?php
    session_start();
    include "../db.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Login - Inventory Managment System</title>
    <link rel="stylesheet" href="../css/logIn.css">
</head>
<body>

<?php
    if(isset($_SESSION['message'])) {
        if($_SESSION['message'] == 'loginfailed') {
            echo '<div id="alert-danger" class="alert">
                    <strong>Failed!</strong> Login and password do not work.
                  </div>';
        }
        unset($_SESSION['message']);
    }
    ?>


    <!-- main div -->
    <div>

        <!-- button to return to index.html -->
        <a class="home" href="../index.html"><i class="fa-solid fa-house fa-2xl"></i></a>

        <!-- Header For Log In Page-->
        <div class="logInHeader">

                <h1>IMS</h1>
                <h3>Inventory Managment System</h3>

        </div>


        <!-- Log In Form -->
        <div class="logInBody">

                <form action="logInProcess.php" method="POST">

                    <div class="logInInput">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="logInInput" method="POST">
                        <label for="password">Password</label>
                        <input type="password" name="userPassword" placeholder="Password" required>
                    </div>
                    
                    <div class="logInButtonContainer">
                        <button type="submit">Login</button>
                    </div>

                </form>

        </div>
    </div>
</body>
<!-- font awsome connection -->
<script src="https://kit.fontawesome.com/ec3dee1045.js" crossorigin="anonymous"></script>
</html>