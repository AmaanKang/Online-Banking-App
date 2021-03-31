<?php
session_start();
?><!DOCTYPE html>
<!--Author:Amandeep Kaur
This php page destroys user session and ultimately logs him out.
-->

<html>

<head>
    <title>Fortune Banking App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bankingApp.css">
</head>

<body>
    <h1>Fortune Banking App</h1>
    <?php
    if (isset($_SESSION["accountNumber"])) {
        session_destroy();
        session_unset();
        echo "<p class='response' >You are logged out</p>";
        echo "<a class = 'linkClass' href = '../index.html'>Go to login page</a>";
    }

    ?>

</body>

</html>