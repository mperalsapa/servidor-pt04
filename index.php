<?php

require_once("internal/db/session_manager.php");

// importem les dependencies internes
require_once("internal/db/mysql.php");
require_once("internal/vistes/pagging.php");
require_once("internal/vistes/browser.php");

// Ens connectem a la base de dades	
$pdo = getMysqlPDO();

$itemsPerPage = 5;
if (checkLogin()) {
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


require_once("vistes/index.vista.php");
