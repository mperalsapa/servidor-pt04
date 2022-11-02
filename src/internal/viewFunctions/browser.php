<?php
// Marc Peral 2 DAW

// funcio basica per redirigir el client a una URL especificada sobre la url base del lloc
function redirectClient(string $url)
{
    include("env.php");

    $redirect = $baseUrl . $url;
    $redirect = str_replace("//", "/", $redirect);

    header("Location: " . $redirect);
    die();
}

function getPathOverBase(): string
{
    include("env.php");
    $parsedUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $parsedUri = "/" . str_replace($baseUrl, "", $parsedUri);
    return $parsedUri;
}
