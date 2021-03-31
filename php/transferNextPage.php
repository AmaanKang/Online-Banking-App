<?php
/**
 * Author:Amandeep Kaur
 * This php file transfers the money by making a connection with the database.
 */
session_start();
include "connect.php";
if(isset($_SESSION["accountNumber"])){
    $fromOK = 0;
    $from = filter_input(INPUT_GET, "from", FILTER_SANITIZE_SPECIAL_CHARS);
    $to = filter_input(INPUT_GET, "to", FILTER_SANITIZE_SPECIAL_CHARS);
    $amount = filter_input(INPUT_GET, "amount", FILTER_VALIDATE_FLOAT);
    if ($from != null && $to != null && $amount != null && $amount == true) {
        if ($from === "cheqAcc") {
            $cmd = "SELECT chequingBalance FROM usersdata WHERE accountNumber = ?";
            $statement = $dbh->prepare($cmd);
            $param = [$_SESSION["accountNumber"]];
            $successful = $statement->execute($param);
            while($row = $statement->fetch()){
                if($row["chequingBalance"] >= $amount){
                    $command = "UPDATE usersdata SET chequingBalance = chequingBalance - ? WHERE accountNumber = ?";
                    if ($to === "cheqAcc") {
                    $command1 = "UPDATE usersdata SET chequingBalance = chequingBalance + ? WHERE accountNumber = ?";
                    } 
                    elseif ($to === "savAcc") {
                    $command1 = "UPDATE usersdata SET savingsBalance = savingsBalance + ? WHERE accountNumber = ?";
                    }
                    $fromOK++;
                }
                else{
                    echo json_encode("Chequing Account balances are not sufficient");
                }
            }
            
        }elseif ($from === "savAcc") {
            $cmd = "SELECT savingsBalance FROM usersdata WHERE accountNumber = ?";
            $statement = $dbh->prepare($cmd);
            $param = [$_SESSION["accountNumber"]];
            $successful = $statement->execute($param);
            while($row = $statement->fetch()){
                if($row["savingsBalance"] >= $amount){
                    $command = "UPDATE usersdata SET savingsBalance = savingsBalance - ? WHERE accountNumber = ?";
                    if ($to === "cheqAcc") {
                     $command1 = "UPDATE usersdata SET chequingBalance = chequingBalance + ? WHERE accountNumber = ?";
                    } 
                    elseif ($to === "savAcc") {
                    $command1 = "UPDATE usersdata SET savingsBalance = savingsBalance + ? WHERE accountNumber = ?";
                    }
                    $fromOK++;
                }
                else{
                    echo json_encode("Savings Account balances are not sufficient");
                }
        }
    }
    if($fromOK > 0){
        $stmt = $dbh->prepare($command);
        $params = [$amount,$_SESSION["accountNumber"]];
        $success = $stmt->execute($params);
        $stmt1 = $dbh->prepare($command1);
        $success1 = $stmt1->execute($params);
        if($success && $success1){
            echo json_encode("Transfer Successful");
        }
        else{
            echo json_encode("Transfer unsuccessful");
        }
    }
        
    }
    else{
        echo json_encode("invalid parameters");
    }
}
else{
    session_unset();
    session_destroy();
    echo "<p class='response'>You are not logged in</p>";
    echo "<a class = 'linkClass' href = '../index.html'>Login Again!</a>";
}
?>