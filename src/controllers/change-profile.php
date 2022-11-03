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
    if ($url != "/change-email") {
        $viewData["resetPassword"] = false;
        $viewData["success"] = false;

        $viewData["postUrl"] = "/change-password";

        include_once("src/views/reset-password.vista.php");
        die();
    }
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
        if (!sendChangeEmailToken($email, $token)) {
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
    include_once("src/views/change-email.vista.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = getMysqlPDO();

    if ($url != "/change-email") {

        $viewData["resetPassword"] = false;
        $viewData["success"] = false;
        if (empty($_POST["password"])) {
            returnAlert("La contrasenya es buida, introdueix una contrasenya valida", "danger", "src/views/reset-password.vista.php", $viewData);
        }
        $password = $_POST["password"];

        if (empty($_POST["verify-password"])) {
            returnAlert("La verificacio de la contrasenya es buida, introdueix una contrasenya valida", "danger", "src/views/reset-password.vista.php", $viewData);
        }
        $password2 = $_POST["verify-password"];

        if ($password != $password2) {
            returnAlert("La verificacio de la contrasenya i la contrasenya no coincideixen. Prova un altre cop", "danger", "src/views/reset-password.vista.php", $viewData);
        }

        setUserPasswordById($pdo, $password, $_SESSION["id"]);
        $viewData["success"] = true;
        returnAlert("S'ha canviat la contrasenya correctament.", "success", "src/views/reset-password.vista.php", $viewData);
    }


    if (!isset($_GET["token"])) {
        redirectClient("/change-email");
    }
    $viewData["token"] = $_GET["token"];
    $viewData["success"] = false;

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

    if (userExists($pdo, $email)) {
        returnAlert("Aquest correu ja s'esta fent servir en un altre compte.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    setUserEmail($pdo, $email, $_SESSION["id"]);

    if (!userExists($pdo, $email)) {
        returnAlert("S'ha produit un error canviant el correu electronic. Si el problema persiteix contacta amb l'administrador", "danger", "src/views/change-email.vista.php", $viewData);
    }


    $viewData["token"] = "";
    $viewData["success"] = true;
    returnAlert("S'ha realitzat el canvi de correu electronic correctament.", "success", "src/views/change-email.vista.php", $viewData);
}
