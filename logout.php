<?php
include_once("internal/db/session_manager.php");
include_once("internal/vistes/browser.php");

if (checkLogin()) {
    setLoggedin(false);
    redirectClient("index.php");
}
