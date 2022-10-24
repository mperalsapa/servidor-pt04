<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/viewFunctions/formError.php");
include_once("src/internal/viewFunctions/browser.php");

function sendLostPasswordEmail(string $emailTo, string $token)
{
    include("env.php");
    $curl = curl_init();

    $emailSender = "no-reply@mperalsapa.cf";
    $emailSenderName = "Articles de Pel·lícules";
    $resetPasswordLink = $baseDomain . $baseUrl . "lost-password?resetToken=$token";
    $htmlContent = "<h1>Test de recuperacio</h1><p>Recuperacio de contrasenya. Fes click en aquest enllaç: <a href=\"$resetPasswordLink\">$resetPasswordLink</a> o copia i enganxa en el navegador.</p>";
    $subject = "Recuperacio de Contrasenya";

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
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["resetToken"])) {
        include_once("src/views/lost-password.vista.php");
    }
    $token = $_GET["resetToken"];
    echo "Token: $token <br>";

    $pdo = getMysqlPDO();
    $tokenData = getPasswordResetToken($pdo, $token);
    if (empty($tokenData)) {
        retornarError("Aquest enllaç de recuperacio ha caducat. Pots demanar un enllaç de recuperacio un altre cop.", "src/views/lost-password.vista.php");
    }
    $tokenTimeStamp = $tokenData["token_caducity"];
    $actualTimestamp = date('Y-m-d H:i:s');

    if ($actualTimestamp < $tokenTimeStamp) {
        $resetPassword = true;
    }

    include_once("src/views/reset-password.vista.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        $formResult = "Si aquest correu existeix, s'enviara un missatge amb un enllaç de recuperacio.";

        include_once("src/internal/db/mysql.php");
        $pdo = getMysqlPDO();
        if (!userExists($pdo, $email)) {
            retornarError($formResult, "src/views/lost-password.vista.php");
        };
        $token = setPasswordResetToken($pdo, $email);
        sendLostPasswordEmail($email, $token);
        retornarError($formResult, "src/views/lost-password.vista.php");
    }
    if (isset($_POST["password"])) {
        $password = $_POST["password"];
        $token = $_GET["resetToken"];

        $pdo = getMysqlPDO();
        changeUserPassword($pdo, $password, $token);
        redirectClient("/login");
    }
}
