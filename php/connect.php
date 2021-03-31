<?php
/**
 * Author:Amandeep Kaur
 * This php file connects the php files to the mysql database
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=bankingApp",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
