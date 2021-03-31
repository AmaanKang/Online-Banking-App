<?php
session_start();
?><!DOCTYPE html>
<!--Author:Amandeep Kaur
This php file helps the user to pay the credit bill.
-->
<html>

<head>
    <title>Fortune Banking App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bankingApp.css">
    <script src="../js/credit.js"></script>
    
</head>

<body>
<h1>Fortune Banking App</h1>
<?php
if(isset($_SESSION["accountNumber"])){
    echo '
    <form id="creditForm" method="GET">
    <span class="label">Select an account to do the payment:</span>
        <select name="from" id="from" form="creditForm" class="textBox">
            <option value = "cheqAcc">Chequing Account</option>
            <option value = "savAcc">Savings Account</option>
        </select></br>
        <span class="label">Amount:</span>
        <input type="number" step="0.01" name="amount" id="amount" class="textBox"/></br>
        <input type="submit" name="payBtn" class="submitBtn" id="payBtn" value="Pay the credit bill"/>
    </form>
    <div id="message"></div></br></br></br></br>
    ';
    echo '<a class = "linkClass" href = "checkBalance.php">Check your Balance</a></br></br></br></br>';
    echo '<a class = "linkClass" href = "signIn.php">Go to Home Page</a>';
    echo "<a class = 'linkClass' href = '../index.html'>Go to Login page</a>";
}
else{
    session_destroy();
    session_unset();
    echo "<p class='response' >You are not being logged in!</p>";
    echo "<a class = 'linkClass' href = '../index.html'>Log in to your account</a>";
}
?>
</body>

</html>