<?php


function retornarError(string $error, string $vista)
{
    $formResult = $error;
    include_once($vista);
    die();
}

function returnAlert(string $message, string $type, string $vista, ?array $viewData = array())
{
    $alertMessage = $message;
    $alertType = $type;
    $alertIcon = "";

    switch ($type) {
        case 'primary':
        case 'info':
            $alertIcon = "<i class=\"bi bi-info-circle\"></i>";
            break;
        case 'success':
            $alertIcon = "<i class=\"bi bi-check-circle\"></i>";
            break;
        case 'warning':
            $alertIcon = "<i class=\"bi bi-exclamation-triangle\"></i>";
            break;
        case 'danger':
            $alertIcon = "<i class=\"bi bi-exclamation-triangle\"></i>";
            break;
    }
    include_once($vista);
    die();
}
