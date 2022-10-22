<?php
// Marc Peral 2 DAW

// funcio basica per redirigir el client a una URL especificada
function redirectClient(string $url): void
{
    header("Location: $url");
    die();
}
