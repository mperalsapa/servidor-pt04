<?php
include_once("internal/registre/registre.php");
include_once("internal/db/mysql.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once("vistes/registre.vista.php");
    die();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST["nom"]) ? $_POST["nom"] : '';
    $lastname = isset($_POST["cognom"]) ? $_POST["cognom"] : '';
    $email = isset($_POST["correu"]) ? $_POST["correu"] : '';
    $email2 = isset($_POST["correu-2"]) ? $_POST["correu-2"] : '';
    $password = isset($_POST["contrasenya"]) ? $_POST["contrasenya"] : '';
    $password2 = isset($_POST["contrasenya-2"]) ? $_POST["contrasenya-2"] : '';

    if (empty($name)) {
        $missatgeForm = "El camp Nom es buit";
    }
    if (empty($lastname)) {
        $missatgeForm = "El camp Cognom es buit";
    }
    if (empty($email)) {
        $missatgeForm = "El camp Email es buit";
    }
    if (empty($email2)) {
        $missatgeForm = "La verificacio de correu es buida";
    }
    if (empty($password)) {
        $missatgeForm = "El camp Contrassenya es buit";
    }
    if (empty($password2)) {
        $missatgeForm = "La verificacio de contrasenya es buida";
    }

    if ($email != $email2) {
        $missatgeForm = "El correu i la verificacio no coincideixen";
    }
    if ($password != $password2) {
        $missatgeForm = "La contrasenya i la verificacio no coincideixen";
    }


    $pdo = getMysqlPDO();


    if (userExists($pdo, $email)) {
        echo "User already exists";
        die();
    };

    echo "Tot correcte.";
}
