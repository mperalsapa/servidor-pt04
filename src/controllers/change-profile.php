<?php
include("env.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");

if (!checkLogin()) {
    redirectClient("/login");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!isset($_GET["token"])) {
        $pdo = getMysqlPDO();
        $userId = $_SESSION["id"];
        $token = setResetTokenById($pdo, $userId);
        returnAlert("S'ha enviat un enllaç al teu correu electronic. Segueix aquest enllaç per realitzar els canvis.", "primary", "src/views/ask-profile-token.vista.php");
    }

    $viewData["token"] = $_GET["token"];
    $url = getPathOverBase();
    switch ($url) {
        case '/change-email':
            include_once("src/views/change-email.vista.php");
            break;
        case '/change-password':
            echo "change password";
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_GET["token"])) {
        redirectClient("/change-email");
    }
    $viewData["token"] = $_GET["token"];

    if (!isset($_POST["email"])) {
        returnAlert("No has introduit un correu electronic.", "danger", "src/views/change-email.vista.php", $viewData);
    }
    $email = $_POST["email"];

    if (!isset($_POST["verify-email"])) {
        returnAlert("No has introduit la verificacio del correu electronic.", "danger", "src/views/change-email.vista.php", $viewData);
    }
    $email2 = $_POST["verify-email"];

    if ($email != $email2) {
        returnAlert("El correu electronic i la verificacio no coincideixen.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    $pdo = getMysqlPDO();
    if (userExists($pdo, $email)) {
        returnAlert("Aquest correu ja s'esta fent servir en un altre compte.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    setUserEmail($pdo, $email, $_SESSION["id"]);

    if (!userExists($pdo, $email)) {
        returnAlert("S'ha produit un error canviant el correu electronic. Si el problema persiteix contacta amb l'administrador", "danger", "src/views/change-email.vista.php", $viewData);
    }




    $viewData["token"] = "";
    returnAlert("S'ha realitzat el canvi de correu electronic.", "success", "src/views/change-email.vista.php", $viewData);
}
