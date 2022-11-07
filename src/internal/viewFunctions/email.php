<?php



function sendLostPasswordEmail(string $emailTo, string $token): bool
{
    include("env.php");
    $curl = curl_init();

    $emailSender = "no-reply@mperalsapa.cf";
    $emailSenderName = "Articles de Pel·lícules";
    $changeEmailLink = $baseDomain . $baseUrl . "lost-password?resetToken=$token";
    $htmlContent = "<h1>Sol·licitut de recuperació de contrasenya</h1><div><p>Fes click en aquest enllaç: <a href=\"$changeEmailLink\">$changeEmailLink</a> o copia i enganxa en el navegador.</p><p>Si no has sigut tu, pots ignorar aquest missatge.</p></div><p>Articles de Pel·licules</p>";
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

function sendChangeEmailToken(string $emailTo, string $token): bool
{
    include("env.php");
    $curl = curl_init();

    $emailSender = "no-reply@mperalsapa.cf";
    $emailSenderName = "Articles de Pel·lícules";
    $changeEmailLink = $baseDomain . $baseUrl . "change-email?token=$token";
    $htmlContent = "<h1>Sol·licitut de Canvi de Correu Electrónic</h1><div><p>Fes click en aquest enllaç: <a href=\"$changeEmailLink\">$changeEmailLink</a> o copia i enganxa en el navegador.</p><p>Si no has sigut tu, pots ignorar aquest missatge.</p></div><p>Articles de Pel·licules</p>";
    $subject = "Canvi de Correu Electrónic";

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

function sendDeleteAccountToken(string $emailTo, string $token): bool
{
    include("env.php");
    $curl = curl_init();

    $emailSender = "no-reply@mperalsapa.cf";
    $emailSenderName = "Articles de Pel·lícules";
    $changeEmailLink = $baseDomain . $baseUrl . "delete-account?token=$token";
    $htmlContent = "<h1>Sol·licitut d'eliminacio de compte</h1><div><p>RECORDA QUE AQUESTA ACCIO ES IRREVERSIBLE.</p><p>Fes click en aquest enllaç: <a href=\"$changeEmailLink\">$changeEmailLink</a> o copia i enganxa en el navegador.</p><p>Si no has sigut tu, pots ignorar aquest missatge.</p></div><p>Articles de Pel·licules</p>";
    $subject = "Eliminacio de compte";

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
