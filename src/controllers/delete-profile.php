<?php
include("env.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");
include_once("src/internal/viewFunctions/email.php");
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");

if (!checkLogin()) {
    redirectClient("/login");
}

$url = getPathOverBase();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pdo = getMysqlPDO();
    if (!isset($_GET["token"])) {
        $userId = $_SESSION["id"];
        $email = getUserEmail($pdo, $userId);

        $lastTokenTimestamp = strtotime(getLastTokenTimestamp($pdo, $email));
        $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

        $timeSinceLastTry = $actualTimestamp - $lastTokenTimestamp;
        $minWaitTimeMinute = 5;

        if ($timeSinceLastTry < $minWaitTimeMinute * 60) {
            $message = "Has d'esperar $minWaitTimeMinute minuts avans de tornar a intentar-ho.";
            returnAlert($message, "danger", "src/views/ask-profile-token.vista.php");
        }

        $token = setResetTokenByEmail($pdo, $email);
        if (!sendDeleteAccountToken($email, $token)) {
            returnAlert("S'ha produit un error a l'hora d'enviar el missatge. Si el problema persisteix, contacta amb un administrador", "danger", "src/views/ask-profile-token.vista.php");
        };

        returnAlert("S'ha enviat un enllaç al teu correu electronic. Segueix aquest enllaç per realitzar els canvis.", "primary", "src/views/ask-profile-token.vista.php");
    }

    $token = $_GET["token"];
    $tokenData = getResetToken($pdo, $token);

    $errorMessage = "Aquest enllaç de recuperacio ha caducat. Pots demanar un enllaç de recuperacio un altre cop.";
    if (empty($tokenData)) {
        returnAlert($errorMessage, "danger", "src/views/ask-profile-token.vista.php");
    }
    $tokenTimeStamp = strtotime($tokenData["token_caducity"]);
    $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

    if ($actualTimestamp > $tokenTimeStamp) {
        returnAlert($errorMessage, "danger", "src/views/ask-profile-token.vista.php");
    }

    $viewData["token"] = $token;
    $viewData["success"] = false;
    include_once("src/views/delete-profile.vista.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = getMysqlPDO();

    $viewData["token"] = "";
    $viewData["success"] = true;

    if (!isset($_GET["token"])) {
        redirectClient("/change-email");
    }

    if (!isset($_POST["submit"]) || $_POST["submit"] != "delete") {
        echo "<br>";
        print_r($_POST);
        echo "<br>";
        echo "<br>";
        returnAlert("S'ha produit un error a l'hora d'esborrar el compte, prova un altre cop. Si el problema persisteix, contacta amb un administrador.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    removeUserAccount($pdo, getUserIDSession());
    session_destroy();
    returnAlert("S'ha esborrat el compte correctament.", "success", "src/views/change-email.vista.php", $viewData);
}
