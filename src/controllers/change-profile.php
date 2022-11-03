<?php
include("env.php");
include_once("src/internal/viewFunctions/browser.php");

$url = getPathOverBase();

switch ($url) {
    case '/change-email':
        include_once("src/views/change-email.vista.php");
        break;
    case '/change-password':
        echo "change password";
        break;
}
