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
