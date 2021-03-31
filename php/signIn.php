<?php

session_start();

include "connect.php";
$userID = filter_input(INPUT_POST, "userID", FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
$isOK = 0;
$pwdOK = false;

?>
<!DOCTYPE html>
<!--Author:Amandeep Kaur
This php file is the home page of app and responds to a user's login.
-->
<html>

<head>
    <title>Fortune Banking App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bankingApp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("body").fadeOut(10, function() {
                $("body").fadeIn(5000);
            });

            $(".link").mouseover(function() {
                $(this).css({
                    "font-size": "1.8em",
                    "color": "green",
                    "text-decoration": "none"
                });
            });
            $(".link").mouseout(function() {
                $(this).css({
                    "font-size": "1.2em",
                    "color": "red",
                    "text-decoration": "underline"
                });
            });
            $("img").animate({
                width: "20%",
                height: "20%"
            }, 5000)
        });
    </script>
</head>

<body>
    <h1>Fortune Banking App</h1>
    <?php
    /**
     * If the entered data is valid and user is logged in, then perform further steps.
     */
    if (($userID != null && $pass != null) || isset($_SESSION["accountNumber"])) {
        $command = "SELECT * FROM bankusers";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();
        while ($row = $stmt->fetch()) {
            if (password_verify($pass, $row["userPassword"])) {
                $pwdOK = true;
            }
            if ($row["userID"] == $userID && $pwdOK) {
                $_SESSION["accountNumber"] = $row["accountNumber"];
            }
        }
        if (isset($_SESSION["accountNumber"])) {
            echo "<div class='block'><h1 id='welcome'>Welcome to the Home Page</h1>";
            echo "<a class = 'link' href = '../php/checkBalance.php'>Check Balance</a></br>
          <a class = 'link' href = '../php/transfer.php'>Transfer between accounts</a></br>
          <a class = 'link' href = '../php/payment.php'>Make Payment to a Payee</a></br>
          <a class = 'link' href = '../php/credit.php'>Pay the credit bill</a></br>
          <a class = 'link' href = '../php/updateProfile.php'>Update your bank profile</a></div>
          <a class = 'link' href='../php/logout.php'>Log Out</a></br></br>";
            echo "<div id='imgId'><div class='imgBlock'><img src='../images/checkBalance.jpg' alt='Check the account balance'</div>";
            echo "<div class='imgBlock'><img src='../images/transfer.jpg' alt='Transfer between your accounts'</div>";
            echo "<div class='imgBlock'><img src='../images/payment.jpg' alt='Make a payment'</div>";
            echo "<div class='imgBlock'><img src='../images/update.png' alt='Update the profile'
    </div></div>";
        } else {
            session_unset();
            session_destroy();
            echo "<p class='response'>Login error</p>";
            echo "<a class = 'linkClass' href = '../index.html'>Login Again!</a>";
        }
    } else {
        session_unset();
        session_destroy();
        echo "<p class='response'>Invalid Data entered or login error</p>";
        echo "<a class = 'linkClass' href = '../index.html'>Login Again!</a>";
    }

    ?>
</body>

</html>