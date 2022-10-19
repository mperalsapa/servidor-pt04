<?php
include_once("internal/db/mysql.php");
include_once("internal/db/session_manager.php");
include_once("internal/vistes/browser.php");

function checkCaptcha(string $captchaResponse): bool
{

    $data = array(
        'secret' => "0x6A8238ab6E15bE018e4f6d43DaA1888C30443e0F",
        'response' => $captchaResponse
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    $responseData = json_decode($response);
    if ($responseData->success) {
        return true;
        // your success code goes here
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (checkLogin()) {
        redirectClient("index.php");
    }
    include_once("vistes/login.vista.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    $pdo = getMysqlPDO();
    if (!userExists($pdo, $email)) {
        $formResult = "El compte introduit no existeix. Si vols, et pots registrar aqui: <a href=\"register.php\">Registre</a>";
        include_once("vistes/login.vista.php");
        die();
    }

    if (!checkUserPassword($pdo, $password, $email)) {
        $formResult = "La contrasenya introduida no es correcte. Si no la recordes, fes una recuperació aqui: <a class=\"link-light\" href=\"lost-password.php\">Recuperació de contrasenya</a>";
        setLoginAttempt(getLoginAttempts() + 1);
        include_once("vistes/login.vista.php");
        die();
    }

    if (getLoginAttempts() > 2) {

        if (!isset($_POST['h-captcha-response'])) {
            $formResult = "S'ha produit un error validant el captcha. Torna a probar.";
            include_once("vistes/login.vista.php");
            die();
        }

        $validCaptcha = checkCaptcha($_POST['h-captcha-response']);
        if (!$validCaptcha) {
            $formResult = "No has omplert el captcha correctament. Torna a probar.";
            include_once("vistes/login.vista.php");
            die();
        }
    }

    setLoginAttempt(0);

    $initials = getUserInitials($pdo, $email);
    setInitials($initials);
    $id = getUserID($pdo, $email);
    setUserID($id);
    setLoggedin(true);

    $redirectTitle = "Inici de sessio completat";
    $redirectLocation = "l'inici";
    $redirectLink = "index.php";

    include_once("vistes/redirect.vista.php");
}
