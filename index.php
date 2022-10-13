<?php

require_once("internal/db/session_manager.php");

// importem les dependencies internes
require_once("internal/db/mysql.php");
require_once("internal/vistes/pagging.php");
require_once("internal/vistes/browser.php");

// Ens connectem a la base de dades	
$pdo = getMysqlPDO();

// comprovem el numero d'articles
$artCount = getArticleCount($pdo);

// si no hi ha articles, redirigim a l'arrel del domini
if ($artCount == 0) {
  redirectClient("/");
}

// definim les variables de la paginacio
// definim el numero maxim d'articles per pagina
$itemsPerPage = 5;
$minPage = 1;
$maxPage = checkMaxPage($pdo, $itemsPerPage);
$page = getPagNumber($maxPage);

// sol·licitem els articles paginats
$articles = getArticlePage($pdo, $page, $itemsPerPage);

// i finalment mostrem la vista
require_once("vistes/index.vista.php");
