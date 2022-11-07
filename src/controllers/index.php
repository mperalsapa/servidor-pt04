<?php
// Marc Peral
// script que s'encarrega de l'index del lloc

// importem les funcions que farem servir
require_once("src/internal/db/session_manager.php");
require_once("src/internal/db/mysql.php");
require_once("src/internal/viewFunctions/pagging.php");
require_once("src/internal/viewFunctions/browser.php");

// Ens connectem a la base de dades	
$pdo = getMysqlPDO();

// configurem el numero d'items per pagina, es a dir, quantitat d'articles per pagina
$itemsPerPage = 5;
// si la url no conté "art" configurem $meArticles a true.
// aquest atribut fa que es mostrin els articles de l'usuari que conte sessio iniciada
// o que es mostrin tots els articles

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
