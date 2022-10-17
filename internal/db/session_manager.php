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

function setInitials(string $initials)
{
    $name = $initials[0];
    $surname = $initials[1];
    $_SESSION["name-initial"] = $name;
    $_SESSION["surname-initial"] = $surname;
}
