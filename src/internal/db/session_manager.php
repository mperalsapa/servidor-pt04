<?php
if (session_status() == 1) {
    session_start();
}

function checkLogin(): bool
{
    if (!isset($_SESSION["loggedin"])) {
        $_SESSION["loggedin"] = false;
    }

    if ($_SESSION["loggedin"]) {
        return true;
    }
    return false;
}

function setLoggedin(bool $loggedin)
{
    $_SESSION["loggedin"] = $loggedin;
}

function setInitials(array $initials)
{
    $_SESSION["name-initial"] = $initials[0];
    $_SESSION["surname-initial"] = $initials[1];
}

function setUserID(string $userID)
{
    $_SESSION["id"] = $userID;
}
function getUserIDSession(): int
{
    return $_SESSION["id"];
}


function getLoginAttempts(): int
{
    if (isset($_SESSION["login-attempts"])) {
        return $_SESSION["login-attempts"];
    }
    return 0;
}

function setLoginAttempt(int $attempt)
{
    $_SESSION["login-attempts"] = $attempt;
}

function setUserLoggedinData(PDO $pdo, string $email)
{
    setLoginAttempt(0);
    $initials = getUserInitials($pdo, $email);
    setInitials($initials);
    $id = getUserID($pdo, $email);
    setUserID($id);
    setLoggedin(true);
}
