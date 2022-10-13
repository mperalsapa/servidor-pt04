<?php
session_start();

$loggedinkey = "loggedin";

if (!isset($_SESSION[$loggedinkey])) {
    $_SESSION[$loggedinkey] = false;
}

if ($_SESSION[$loggedinkey]) {
    echo "Logged in";
} else {
    echo "not logged in";
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
