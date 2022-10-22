<?php
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

if (checkLogin()) {
    session_destroy();
    redirectClient("/");
}
