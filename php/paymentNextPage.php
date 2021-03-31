<?php

/**
 * Author:Amandeep Kaur
 * This php file makes a payment to a payee by asking for the email address of the payee. 
 */
session_start();
include "connect.php";
$command = "";
$eligible = 0;
if (isset($_SESSION["accountNumber"])) {
    $from = filter_input(INPUT_GET, "from", FILTER_SANITIZE_SPECIAL_CHARS);
    $emailAddr = filter_input(INPUT_GET, "emailAddr", FILTER_VALIDATE_EMAIL);
    $amount = filter_input(INPUT_GET, "amount", FILTER_VALIDATE_FLOAT);
    if ($from != null && $emailAddr != null && $amount != null && $amount == true) {
        if ($from === "cheqAcc") {
            $cmd = "SELECT chequingBalance FROM usersdata WHERE accountNumber = ?";
            $statement = $dbh->prepare($cmd);
            $param = [$_SESSION["accountNumber"]];
            $successful = $statement->execute($param);
            while ($row = $statement->fetch()) {
                if ($row["chequingBalance"] >= $amount) {
                    $command = "UPDATE usersdata SET chequingBalance = chequingBalance - ?  WHERE accountNumber = ?";
                    $eligible++;
                } else {
                    echo json_encode("Chequing Account balances are not sufficient");
                }
            }
        } elseif ($from === "savAcc") {
            $cmd = "SELECT savingsBalance FROM usersdata WHERE accountNumber = ?";
            $statement = $dbh->prepare($cmd);
            $param = [$_SESSION["accountNumber"]];
            $successful = $statement->execute($param);
            while ($row = $statement->fetch()) {
                if ($row["savingsBalance"] >= $amount) {
                    $command = "UPDATE usersdata SET savingsBalance = savingsBalance - ?  WHERE accountNumber = ?";
                    $eligible++;
                } else {
                    echo json_encode("Savings Account balances are not sufficient");
                }
            }
        }
        if ($eligible > 0) {
            $stmt = $dbh->prepare($command);
            $params = [$amount, $_SESSION["accountNumber"]];
            $success = $stmt->execute($params);
            if ($success) {
                echo json_encode("Payment Successful");
            } else {
                echo json_encode("Payment Unsuccessful");
            }
        }
    } else {
        echo json_encode("Invalid data entered!");
    }
} else {
    session_unset();
    session_destroy();
    echo "<p class='response'>You are not logged in</p>";
    echo "<a class = 'linkClass' href = '../index.html'>Login Again!</a>";
}
