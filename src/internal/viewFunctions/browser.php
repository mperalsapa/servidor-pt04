<?php
// Marc Peral 2 DAW

// funcio basica per redirigir el client a una URL especificada sobre la url base del lloc
function redirectClient(string $url)
{
    include("env.php");

    $redirect = $baseUrl . $url;
    $redirect = str_replace("//","/", $redirect);

    header("Location: " . $redirect);
    die();
}
