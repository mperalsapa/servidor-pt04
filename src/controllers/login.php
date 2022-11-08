<?php
// Marc Peral
// script que s'encarrega del proces de iniciar sessio

// importem les funcions necesaries
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");

// comprovem si la sol·licitut es GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // comprovem si l'usuari ja ha inciat sessio. Si es aixi, redireccionem a l'arrel
    if (checkLogin()) {
        redirectClient("/");
    }

    // comprovem si NO demanem login social. Si es aixi, mostrem la vista de inici de sessio
    if (!isset($_GET["socialLogin"])) {
        include_once("src/views/login.vista.php");
        die();
    }

    // en cas de demanar login social importem les funcions necesaries
    include("env.php");
    include_once("src/internal/viewFunctions/social-login.php");

    // comprovem el login social demanat, i cridem la funcio correspondent per iniciar sessio (hybridAuth)
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

    // en cas de no tenir un login social valid, mostrem la vista de login
    include_once("src/views/login.vista.php");
    die();
}

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // comprovem si les dades d'inici de sessio son omplertes, en cas de no ser-ho les guardem buides
    // TODO consistencia if ?
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    // iniciem la conexio amb la base de dades
    $pdo = getMysqlPDO();

    // si l'usuari demanat no existeix mostrem una alerta que ho indica
    if (!userExists($pdo, $email)) {
        $formResult = "El compte introduit no existeix. Si vols, et pots registrar aqui: <a class=\"alert-link\" href=\"register\">Registre</a>";
        returnAlert($formResult, "danger", "src/views/login.vista.php");
    }
    // si l'usuari existeix, guardem el correu en una variable
    $viewData["email"] = $email;

    // comprovem si la contrasenya es valida amb la que tenim guardada a la base de dades
    if (!checkUserPassword($pdo, $password, $email)) {
        $formResult = "La contrasenya introduida no es correcte. Si no la recordes, fes una recuperació aqui: <a class=\"alert-link\" href=\"lost-password\">Recuperació de contrasenya</a>";
        setLoginAttempt(getLoginAttempts() + 1);
        returnAlert($formResult, "danger", "src/views/login.vista.php", $viewData);
    }

    // comprovem si els intents d'inici de sessio son mes de 2
    if (getLoginAttempts() > 2) {
        // si es major de 2, comprovem si el camp del captcha es buit
        if (!isset($_POST['h-captcha-response'])) {
            $formResult = "S'ha produit un error validant el captcha. Torna a probar.";
            returnAlert($formResult, "danger", "src/views/login.vista.php", $viewData);
        }

        // preguntem al servei de captcha si el formulari es valid, en cas de no ser-ho mostre una alerta
        $validCaptcha = checkCaptcha($_POST['h-captcha-response']);
        if (!$validCaptcha) {
            $formResult = "No has omplert el captcha correctament. Torna a probar.";
            returnAlert($formResult, "danger", "src/views/login.vista.php", $viewData);
        }
    }

    // si tot es correcte, guardem les dades necessaries en la sessio de l'usuari i redireccionem a l'arrel
    setUserLoggedinData($pdo, $email);
    redirectClient("/");
}
