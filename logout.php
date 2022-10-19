<?php
include_once("internal/db/session_manager.php");
include_once("internal/vistes/browser.php");

if (checkLogin()) {
    session_destroy();
    redirectClient("index.php");
}
