<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

if (!checkLogin()) {
    redirectClient("/login");
}


$userId = getUserIDSession();

$pdo = getMysqlPDO();
$userName = getUserName($pdo, $userId);

include_once("src/views/profile.vista.php");
