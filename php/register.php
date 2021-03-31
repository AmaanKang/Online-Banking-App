<!DOCTYPE html>
<!--Author:Amandeep Kaur
This PHP file creates the user account and save it in the database if the entered data meets all the requirements.
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

    include "connect.php";
    $userID = filter_input(INPUT_POST, "userID", FILTER_SANITIZE_SPECIAL_CHARS);
    $accNum = filter_input(INPUT_POST, "accNum", FILTER_VALIDATE_INT);
    $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPass = filter_input(INPUT_POST, "confirmPass", FILTER_SANITIZE_SPECIAL_CHARS);
    $isInt = 0;
    $isLower = 0;
    $isUpper = 0;
    $isSpecialChar = 0;
    $hasAcc = false;
    $idIsInUse = false;
    $accountPresent = false;
    /**
     * If the data entered is valid only then the further actions will take place.
     */
    if ($userID != null && $accNum != null && $pass != null && $confirmPass != null) {
        $command = "SELECT accountNumber FROM usersdata";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();
        while ($row = $stmt->fetch()) {
            if ($row["accountNumber"] == $accNum) {
                $hasAcc = true;
            }
        }

        $command = "SELECT userID,accountNumber FROM bankusers";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();
        while ($row = $stmt->fetch()) {
            if ($row["userID"] == $userID) {
                $idIsInUse = true;
            }
            if ($row["accountNumber"] == $accNum) {
                $accountPresent = true;
            }
        }
        /**
         * Check if the password meets all the requirements.
         */
        for ($i = 0; $i < strlen($pass); $i++) {
            if (is_numeric($pass[$i])) {
                $isInt = $isInt + 1;
            }
            if (ctype_lower($pass[$i])) {
                $isLower = $isLower + 1;
            }
            if (ctype_upper($pass[$i])) {
                $isUpper = $isUpper + 1;
            }
            if ($pass[$i] == "!" || $pass[$i] == "$" || $pass[$i] == "%") {
                $isSpecialChar = $isSpecialChar + 1;
            }
        }
        /**
         * If all the requirements are met, create an online account for the user.
         */
        if (
            $isInt > 0 && $isLower > 0 && $isUpper > 0 && $isSpecialChar > 0 && strlen($userID) >= 8 && strlen($pass) >= 8 &&
            strlen($userID) <= 20 && strlen($pass) <= 20 && $hasAcc === true && $idIsInUse === false && $accountPresent === false
            && $pass === $confirmPass
        ) {
            $pwd = password_hash($pass, PASSWORD_BCRYPT);
            $command = "INSERT into bankusers VALUES (?, ?, ?)";
            $stmt = $dbh->prepare($command);
            $params = [$userID, $pwd, $accNum];
            $success = $stmt->execute($params);
            echo "<p class='response'>Your online account has been created</p>";
            echo '<a class = "linkClass" href = "../index.html">Log in to your new account</a>';
        } elseif ($hasAcc === false) {
            echo "<p class='response'>Your bank account number is not valid!</br>
    Make sure that you have an account in our bank!</br>
    or try to enter your account number again!</p>";
            echo '<a class = "linkClass" href="../register.html">Try Again!</a>';
        } elseif ($accountPresent) {
            echo "<p class='response'>There is already an online account created for the given account number!</p>";
            echo '<a class = "linkClass" href="../register.html">Try with other account number</a>';
        } elseif ($idIsInUse) {
            echo "<p class='response'>Sorry, This ID is already being used by another user!</p>";
            echo '<a class = "linkClass" href="../register.html">Use another ID!</a>';
        } elseif ($pass !== $confirmPass) {
            echo "<p class='response'>Both passwords do not match!</p>";
            echo '<a class = "linkClass" href="../register.html">Try Again!</a>';
        } else {
            echo "<p class='response'>Invalid User ID or User Password!</br></p>";
            echo '<a class = "linkClass" href="../register.html">Try Again!</a>';
        }
    }
    else{
        echo "<p class='response'>Invalid Data entered!</br></p>";
        echo '<a class = "linkClass" href="../register.html">Try Again!</a>';
    }

    ?>
</body>

</html>