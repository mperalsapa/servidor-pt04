<?php
include("env.php");
include_once("src/internal/viewFunctions/browser.php");

$url = getPathOverBase();

switch ($url) {
    case '/change-email':
        echo "change email";
        break;
    case '/change-password':
        echo "change password";
        break;
}
