<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

function getArticleData(int $articleId = NULL): array
{
    if (is_null($articleId)) {
        $result = array(
            "formTitle" => "Nou Article",
            "formSubmitButton" => "Crear",
            "date" => "",
            "article" => "",
            "id" => 0,
            "canDelete" => 0
        );
        return $result;
    }

    $pdo = getMysqlPDO();
    $row = getArticleById($pdo, $articleId);
    $row = $row->fetch();

    $articleAuthor = $row["autor"];
    if ($articleAuthor != $_SESSION['id']) {
        redirectClient("/");
    }

    $result = array(
        "formTitle" => "Editar Article",
        "formSubmitButton" => "Guardar",
        "date" => $row["data"],
        "article" => $row["article"],
        "id" => $row["id"],
        "canDelete" => 1
    );

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        $viewData = getArticleData($id);
    } else {
        $viewData = getArticleData();
    }
    include_once("src/views/write-article.vista.php");
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("src/internal/viewFunctions/form-error.php");
    if (!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        $viewData = getArticleData($id);
    } else {
        $viewData = getArticleData();
    }

    if (empty($_POST["article"])) {
        $formResult = "L'article es buit, si el vols esborrar, fes clic a esborrar.";
        returnAlert($formResult, "danger", "src/views/write-article.vista.php", $viewData);
    }
    $viewData["article"] = $_POST["article"];

    if (empty($_POST["article-date"])) {
        $formResult = "La data de l'article es buida.";
        returnAlert($formResult, "danger", "src/views/write-article.vista.php", $viewData);
    }
    $articleData["date"] = $_POST["article-date"];

    $pdo = getMysqlPDO();
    if (!isset($_GET["id"])) {
        addArticle($pdo, $_SESSION["id"], $_POST["article"], $_POST["article-date"]);
        redirectClient("/");
    }

    $articleId = $_GET["id"];
    updateArticle($pdo, $articleId, $article, $date);
    redirectClient("/");
}
