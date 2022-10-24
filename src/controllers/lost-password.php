<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include_once("src/views/lost-password.vista.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("env.php");

    
    
    echo "testing email";
    
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n  \"sender\": {\n    \"name\": \"Articles de Pelicules\",\n    \"email\": \"no-reply@mperalsapa.cf\"\n  },\n  \"to\": [\n    {\n      \"email\": \"marcperal23@gmail.com\",\n      \"name\": \"Marc Peral\"\n    }\n  ],\n  \"htmlContent\": \"<!DOCTYPE html> <html> <body> <h1>Confirm you email</h1> <p>Please confirm your email address by clicking on the link below</p> </body> </html>\",\n  \"textContent\": \"Please confirm your email address by clicking on the link https://text.domain.com\",\n  \"subject\": \"Login Email confirmation\",\n  \"replyTo\": {\n    \"email\": \"no-reply@mperalsapa.cf\",\n    \"name\": \"Articles de Pelicules\"\n  }\n}",
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