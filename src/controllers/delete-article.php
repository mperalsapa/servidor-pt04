<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include_once("src/internal/db/mysql.php");
    include_once("src/internal/db/session_manager.php");
    include_once("src/internal/viewFunctions/browser.php");

    if (isset($_GET["id"])) {
        $articleId = intval($_GET["id"]);
    } else {
        redirectClient("/");
    }

    if (!isset($_SESSION["id"])) {
        redirectClient("/");
    }

    $userId = $_SESSION["id"];

    $pdo = getMysqlPDO();
    $articleAuthor = getArticleAuthor($pdo, $articleId);
    if ($userId != $articleAuthor) {
        redirectClient("/");
    }

    deleteAricle($pdo, $articleId);
    redirectClient("/");
}
