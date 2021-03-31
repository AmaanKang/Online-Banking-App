<?php
/**
 * Author:Amandeep Kaur
 * This php file changes the user password in the database.
 */
session_start();
include "connect.php";
if (isset($_SESSION["accountNumber"])) {
    $newPass = filter_input(INPUT_GET, "pass1", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPass = filter_input(INPUT_GET, "pass2", FILTER_SANITIZE_SPECIAL_CHARS);
    $isInt = 0;
    $isLower = 0;
    $isUpper = 0;
    $isSpecialChar = 0;
    /**
     * Checks if password meets all requirements
     */
    for ($i = 0; $i < strlen($newPass); $i++) {
        if (is_numeric($newPass[$i])) {
            $isInt = $isInt + 1;
        }
        if (ctype_lower($newPass[$i])) {
            $isLower = $isLower + 1;
        }
        if (ctype_upper($newPass[$i])) {
            $isUpper = $isUpper + 1;
        }
        if ($newPass[$i] == "!" || $newPass[$i] == "$" || $newPass[$i] == "%") {
            $isSpecialChar = $isSpecialChar + 1;
        }
    }
    if (
        $isInt > 0 && $isLower > 0 && $isUpper > 0 && $isSpecialChar > 0 && strlen($newPass) >= 8 && strlen($newPass) <= 20
        && $confirmPass === $newPass
    ) {
        $pwd = password_hash($newPass, PASSWORD_BCRYPT);
        $command = "UPDATE bankusers SET userPassword = ? WHERE accountNumber = ?";
        $stmt = $dbh->prepare($command);
        $params = [$pwd, $_SESSION["accountNumber"]];
        $success = $stmt->execute($params);
        if ($success) {
            echo json_encode("Password change successful");
        } else {
            echo json_encode("Password change unsuccessful");
        }
    } elseif ($confirmPass !== $newPass) {
        echo json_encode("Passwords do not match!");
    } else {
        echo json_encode("Password does not meet the requirements");
    }
} else {
    session_unset();
    session_destroy();
    echo "<p class='response'>You are not logged in</p>";
    echo "<a class = 'linkClass' href = '../index.html'>Login Again!</a>";;;
}
