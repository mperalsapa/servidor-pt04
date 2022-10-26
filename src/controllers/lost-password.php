<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/viewFunctions/formError.php");
include_once("src/internal/viewFunctions/browser.php");

function sendLostPasswordEmail(string $emailTo, string $token): bool
{
    include("env.php");
    $curl = curl_init();

    $emailSender = "no-reply@mperalsapa.cf";
    $emailSenderName = "Articles de Pel·lícules";
    $resetPasswordLink = $baseDomain . $baseUrl . "lost-password?resetToken=$token";
    $htmlContent = "<h1>Sol·licitut de recuperació de contrasenya</h1><p>Recuperacio de contrasenya. Fes click en aquest enllaç: <a href=\"$resetPasswordLink\">$resetPasswordLink</a> o copia i enganxa en el navegador.</p><p>Si no has sigut tu, pots ignorar aquest missatge.</p><p>Articles de Pel·licules</p>";
    $subject = "Recuperació de Contrasenya";

    $postContent = json_encode(
        array(
            "sender" => array(
                "name" => $emailSenderName,
                "email" => $emailSender
            ),
            "to" => array(
                array(
                    "email" => $emailTo
                )
            ),
            "htmlContent" => $htmlContent,
            "subject" => $subject,
            "replyTo" => array(
                "email" => $emailSender,
                "name" => $emailSenderName
            )
        )
    );

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postContent,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "api-key: $sendinBlueApiKey",
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return false;
    } else {
        return true;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["resetToken"])) {
        include_once("src/views/lost-password.vista.php");
        die();
    }
    $token = $_GET["resetToken"];

    $pdo = getMysqlPDO();
    $tokenData = getPasswordResetToken($pdo, $token);

    $errorMessage = "Aquest enllaç de recuperacio ha caducat. Pots demanar un enllaç de recuperacio un altre cop.";
    if (empty($tokenData)) {
        returnAlert($errorMessage, "danger", "src/views/lost-password.vista.php");
    }

    $tokenTimeStamp = strtotime($tokenData["token_caducity"]);
    $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

    if ($actualTimestamp < $tokenTimeStamp) {
        include_once("src/views/reset-password.vista.php");
        die();
    }
    returnAlert($errorMessage, "danger", "src/views/lost-password.vista.php");



    $timeSinceLastTry = $actualTimestamp - $lastTokenTimestamp;
    $minWaitTimeMinute = 1;

    if ($timeSinceLastTry < $minWaitTimeMinute * 60) {
        $formResult = "Has d'esperar $minWaitTimeMinut minut avans de tornar a intentar-ho.";
        returnAlert($formResult, "danger", "src/views/lost-password.vista.php");
    }

    returnAlert($errorMessage, "danger", "src/views/lost-password.vista.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        $formResult = "Si aquest correu existeix, s'enviara un missatge amb un enllaç de recuperacio.";

        include_once("src/internal/db/mysql.php");
        $pdo = getMysqlPDO();
        if (!userExists($pdo, $email)) {
            returnAlert($formResult, "primary", "src/views/lost-password.vista.php");
        };

        $lastTokenTimestamp = strtotime(getLastTokenTimestamp($pdo, $email));
        $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

        $timeSinceLastTry = $actualTimestamp - $lastTokenTimestamp;
        $minWaitTimeMinute = 1;

        if ($timeSinceLastTry < $minWaitTimeMinute * 60) {
            $formResult = "Has d'esperar $minWaitTimeMinut minut avans de tornar a intentar-ho.";
            returnAlert($formResult, "danger", "src/views/lost-password.vista.php");
        }

        $token = setPasswordResetToken($pdo, $email);
        if (!sendLostPasswordEmail($email, $token)) {
            $formResult = "S'ha produit un error a l'hora d'enviar el missatge. Si el problema persisteix, contacta amb un administrador";
            returnAlert($formResult, "danger", "src/views/lost-password.vista.php");
        };
        returnAlert($formResult, "primary", "src/views/lost-password.vista.php");
    }
    if (isset($_POST["password"])) {
        $password = $_POST["password"];
        $token = $_GET["resetToken"];

        $pdo = getMysqlPDO();
        changeUserPassword($pdo, $password, $token);
        redirectClient("/login");
    }
}
