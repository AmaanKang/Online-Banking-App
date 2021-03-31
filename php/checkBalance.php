<?php
session_start();
include "connect.php";
$cheqBal;
$savBal;
$creditBal;
?><!DOCTYPE html>
<!--Author:Amandeep Kaur
This php file checks the balance of user in his bank account by using sql statements and display that account balance.
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
    if(isset($_SESSION["accountNumber"])){
        $command = "SELECT chequingBalance,savingsBalance,creditBalance FROM usersdata WHERE accountNumber=?";
        $stmt = $dbh->prepare($command);
        $params = [$_SESSION["accountNumber"]];
        $success = $stmt->execute($params);

        while($row = $stmt->fetch()){
            $cheqBal = $row["chequingBalance"];
            $savBal = $row["savingsBalance"];
            $creditBal = $row["creditBalance"];
        }
        echo '
        <div id="cheqBal" class="section"><p>Chequing Account:</p>$'.
        $cheqBal.'</div>
        <div id="savBal" class="section"><p>Savings Account:</p>
        $'.$savBal.'</div>
        <div id="creditBal" class="section"><p>Credit Card:</p>
        $'.$creditBal.'</div>
        ';
        echo '<a class = "linkClass" href = "signIn.php">Go to Home Page</a>';
        
        echo "<a class = 'linkClass' href = '../index.html'>Go to Login page</a>";
    }
    else{
        session_unset();
        session_destroy();
        echo "<p class='response' >You are not being logged in!</p>";
        echo "<a class = 'linkClass' href = '../index.html'>Log in to your account</a>";
    }
    ?>
    
    
</body>

</html>