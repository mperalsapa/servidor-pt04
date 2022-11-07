<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (checkLogin()) {
        redirectClient("/");
    }

    if (!isset($_GET["socialLogin"])) {
        include_once("src/views/login.vista.php");
        die();
    }

    include("env.php");
    include_once("src/internal/viewFunctions/social-login.php");
    switch ($_GET["socialLogin"]) {
        case 'google':
            googleLogin($googleClientID, $googleClientSecret, $callbackUrl);
            break;
        case 'github':
            githubLogin($githubClientID, $githubClientSecret, $callbackUrl);
            break;
        case 'twitter':
            twitterLogin($twitterClientID, $twitterClientSecret, $callbackUrl);
            break;
    }

    include_once("src/views/login.vista.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    $pdo = getMysqlPDO();
    if (!userExists($pdo, $email)) {
        $formResult = "El compte introduit no existeix. Si vols, et pots registrar aqui: <a class=\"alert-link\" href=\"register\">Registre</a>";

        returnAlert($formResult, "danger", "src/views/login.vista.php");
        die();
    }

    $viewData["email"] = $email;

    if (!checkUserPassword($pdo, $password, $email)) {
        $formResult = "La contrasenya introduida no es correcte. Si no la recordes, fes una recuperació aqui: <a class=\"alert-link\" href=\"lost-password\">Recuperació de contrasenya</a>";
        setLoginAttempt(getLoginAttempts() + 1);
        returnAlert($formResult, "danger", "src/views/login.vista.php", $viewData);
        die();
    }

    if (getLoginAttempts() > 2) {

        if (!isset($_POST['h-captcha-response'])) {
            $formResult = "S'ha produit un error validant el captcha. Torna a probar.";
            returnAlert($formResult, "danger", "src/views/login.vista.php", $viewData);
        }

        $validCaptcha = checkCaptcha($_POST['h-captcha-response']);
        if (!$validCaptcha) {
            $formResult = "No has omplert el captcha correctament. Torna a probar.";
            returnAlert($formResult, "danger", "src/views/login.vista.php", $viewData);
        }
    }


    setUserLoggedinData($pdo, $email);
    redirectClient("/");
}
