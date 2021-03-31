<?php
session_start();
?><!DOCTYPE html>
<!--Author:Amandeep Kaur
This PHP file has the form to update the user id or password as per user's choice.
-->

<html>

<head>
    <title>Fortune Banking App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bankingApp.css">
    <script src="../js/updateProfile.js"></script>
</head>

<body>
    <h1>Fortune Banking App</h1>
    <?php
    if (isset($_SESSION["accountNumber"])) {
        echo '
    <form id="updateFormID" method="GET">
    <span class="label">Enter new user ID:</span>
        <input type="text" id="userID"  class="textBox" required/></br>
        <input type="submit" id="changeID" class="submitBtn" value="Change User ID"/>
    </form>
    <br/><br/><br/>
    <form id="updateFormPass" method="GET">
    <span class="label">New User Password:</span>
        <input type="password" id="pass1"  class="textBox" required/></br>
    <span class="label">Confirm new Password:</span>
        <input type="password" id="pass2"  class="textBox" required/></br>
        <input type="submit" id="changePass" class="submitBtn" value="Change User Password"/>
    </form>
    <div id="updated"></div></br></br></br></br>
    ';
        echo '<a class = "linkClass" href = "signIn.php">Go to Home Page</a>';
        echo "<a class = 'linkClass' href = '../index.html'>Go to Login page</a>";
    } else {
        session_destroy();
        session_unset();
        echo "<p class='response' >You are not being logged in!</p>";
        echo "<a class = 'linkClass' href = '../index.html'>Log in to your new account</a>";
    }
    ?>
    

</body>

</html>