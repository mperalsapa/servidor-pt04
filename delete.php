<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include_once("internal/db/mysql.php");
    include_once("internal/db/session_manager.php");
    include_once("internal/vistes/browser.php");

    if (isset($_GET["id"])) {
        $articleId = intval($_GET["id"]);
    } else {
        redirectClient("index.php");
    }

    if (!isset($_SESSION["id"])) {
        redirectClient("index.php");
    }

    $userId = $_SESSION["id"];

    $pdo = getMysqlPDO();
    $articleAuthor = getArticleAuthor($pdo, $articleId);
    if ($userId != $articleAuthor) {
        redirectClient("index.php");
    }

    deleteAricle($pdo, $articleId);
    redirectClient("index.php");
}
