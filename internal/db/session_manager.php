<?php
session_start();

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
