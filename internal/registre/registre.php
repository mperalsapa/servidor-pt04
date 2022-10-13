<?php

function checkForm(): string
{
    $name = isset($_POST["nom"]) ? $_POST["nom"] : '';
    $lastname = isset($_POST["cognom"]) ? $_POST["cognom"] : '';
    $email = isset($_POST["correu"]) ? $_POST["correu"] : '';
    $email2 = isset($_POST["correu-2"]) ? $_POST["correu-2"] : '';
    $password = isset($_POST["contrasenya"]) ? $_POST["contrasenya"] : '';
    $password2 = isset($_POST["contrasenya-2"]) ? $_POST["contrasenya-2"] : '';

    if (empty($name)) {
        return "El camp Nom es buit";
    }
    if (empty($lastname)) {
        return "El camp Cognom es buit";
    }
    if (empty($email)) {
        return "El camp Email es buit";
    }
    if (empty($email2)) {
        return "La verificacio de correu es buida";
    }
    if (empty($password)) {
        return "El camp Contrassenya es buit";
    }
    if (empty($password2)) {
        return "La verificacio de contrasenya es buida";
    }

    return "";

    if (empty($name) || empty($lastname) || empty($email) || empty($password)) {
        include_once("vistes/registre.vista.php");
        die();
    }
}

function checkEmail()
{
}
