<?php
// Marc Peral 2 DAW

// funcio basica per redirigir el client a una URL especificada sobre la url base del lloc
function redirectClient(string $url): void
{
    include("env.php");
    header("Location: " . $baseUrl . $url);
    die();
}
