<?php
/**
 * Author:Amandeep Kaur
 * This php file changes user ID.
 */
session_start();
include "connect.php";
if(isset($_SESSION["accountNumber"])){
    $newID = filter_input(INPUT_GET,"userID",FILTER_SANITIZE_SPECIAL_CHARS);
    $idIsInUse = false;
    
    $command = "SELECT userID FROM bankusers";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute();
    while($row = $stmt -> fetch()){
        if($row["userID"] == $newID){
            $idIsInUse = true;
        }
    }
    if($newID != null && strlen($newID) >= 8 && strlen($newID) <= 20 && $idIsInUse === false){
        $command = "UPDATE bankusers SET userID = ? WHERE accountNumber = ?";
        $stmt = $dbh->prepare($command);
        $params = [$newID,$_SESSION["accountNumber"]];
        $success = $stmt->execute($params);
        if($success){
            echo json_encode("User ID changed successfully");
        }
        else{
            echo json_encode("User ID cannot be changed!");
        }
    }
    elseif($newID == null || strlen($newID) < 8 || strlen($newID) > 20){
        echo json_encode("Entered User ID is not valid");
    }
    elseif($idIsInUse === true){
        echo json_encode("This ID cannot be used");
    }
}
else{
    session_unset();
    session_destroy();
    echo "<p class='response'>You are not logged in</p>";
    echo "<a class = 'linkClass' href = '../index.html'>Login Again!</a>";
}

?>