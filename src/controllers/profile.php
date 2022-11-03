<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

if (!checkLogin()) {
    redirectClient("/login");
}


$userId = getUserIDSession();

$pdo = getMysqlPDO();



$userData = getUserName($pdo, $userId);
$name = $userData["nom"] . " " . $userData["cognoms"];
$email = $userData["correu"];

include_once("src/views/profile.vista.php");
