<?php
include_once("internal/db/mysql.php");
include_once("internal/db/session_manager.php");
include_once("internal/vistes/browser.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!isset($_GET["id"])) {
        $formTitle = "Nou Article";
        $formSubmitButton = "Crear";
        include_once("vistes/write.vista.php");
        die();
    }


    $articleId = $_GET["id"];
    $formTitle = "Editar Article";
    $formSubmitButton = "Guardar";
    $pdo = getMysqlPDO();
    $row = getArticleById($pdo, $articleId);
    $row = $row->fetch();
    $article = $row["article"];
    $date = $row["data"];
    $articleAuthor = $row["autor"];
    if ($articleAuthor != $_SESSION['id']) {
        redirectClient("index.php");
    }

    include_once("vistes/write.vista.php");
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("internal/vistes/formError.php");

    if (!isset($_POST["article"])) {
        echo "Error, Camp article no existeix.";
    }
    if (!isset($_POST["article-date"])) {
        echo "Error, Camp data no existeix.";
    }
    if (empty($_POST["article"])) {
        $formResult = "L'article es buit, si el vols esborrar, fes clic a esborrar.";
        retornarError($formResult, "vistes/write.vista.php");
    }
    if (empty($_POST["article-date"])) {
        $formResult = "La data de l'article es buida.";
        retornarError($formResult, "vistes/write.vista.php");
    }

    $pdo = getMysqlPDO();
    addArticle($pdo, $_SESSION["id"], $_POST["article"], $_POST["article-date"]);
    redirectClient("index.php");
}
