<?php

require_once("src/internal/db/session_manager.php");

// importem les dependencies internes
require_once("src/internal/db/mysql.php");
require_once("src/internal/viewFunctions/pagging.php");
require_once("src/internal/viewFunctions/browser.php");

// Ens connectem a la base de dades	
$pdo = getMysqlPDO();

$itemsPerPage = 5;
if (isset($_GET["art"])) {
  $meArticles = $_GET["art"] == "me" ? true : false;
} else {
  $meArticles = true;
}

if (checkLogin() && $meArticles) {
  $userid = $_SESSION["id"];
  $artCount = getArticleCountByUser($pdo, $userid);
  if (!$artCount == 0) {
    $maxPage = ceil($artCount / $itemsPerPage);
    $page = getPagNumber($maxPage);
    $articles = getArticlePageByUser($pdo, $page, $itemsPerPage, $userid);
  } else {
    $articles = '';
    $page = 1;
    $maxPage = 1;
  }
} else {
  $artCount = getArticleCount($pdo);
  if ($artCount == 0) {
    redirectClient("/");
  }
  $maxPage = ceil($artCount / $itemsPerPage);
  $page = getPagNumber($maxPage);

  $articles = getArticlePage($pdo, $page, $itemsPerPage);
}


require_once("src/views/index.vista.php");
