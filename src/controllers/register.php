<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/formError.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (checkLogin()) {
        redirectClient("/");
    }
    include_once("vistes/register.vista.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $email2 = isset($_POST["verify-email"]) ? $_POST["verify-email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $password2 = isset($_POST["verify-password"]) ? $_POST["verify-password"] : '';

    if (empty($name)) {
        $formResult = "El camp Nom es buit";
        retornarError($formResult, "vistes/register.vista.php");
    }
    if (empty($lastname)) {
        $formResult = "El camp Cognom es buit";
        retornarError($formResult, "vistes/register.vista.php");
    }
    if (empty($email)) {
        $formResult = "El camp Email es buit";
        retornarError($formResult, "vistes/register.vista.php");
    }
    if (empty($email2)) {
        $formResult = "La verificacio de correu es buida";
        retornarError($formResult, "vistes/register.vista.php");
    }
    if (empty($password)) {
        $formResult = "El camp Contrassenya es buit";
        retornarError($formResult, "vistes/register.vista.php");
    }
    if (empty($password2)) {
        $formResult = "La verificacio de contrasenya es buida";
        retornarError($formResult, "vistes/register.vista.php");
    }

    if ($email != $email2) {
        $formResult = "El correu i la verificacio no coincideixen";
        retornarError($formResult, "vistes/register.vista.php");
    }
    if ($password != $password2) {
        $formResult = "La contrasenya i la verificacio no coincideixen";
        retornarError($formResult, "vistes/register.vista.php");
    }

    $pdo = getMysqlPDO();
    if (userExists($pdo, $email)) {
        $formResult = "Aquest correu ja pertany a un compte. Si no recordes la contrasenya, fes una recuperació aqui: <a href=\"lost-password.php\">Recuperació de contrasenya</a>";
        retornarError($formResult, "vistes/register.vista.php");
    };

    $insertsuccess = addUser($pdo, $name, $lastname, $email, $password);
    if ($insertsuccess) {
        setUserLoggedinData($pdo, $email);
        redirectClient("/");
    } else {
        $formResult = "S'ha produit un error a l'hora de realitzar el register. Intenta-ho un altre cop.";
        include_once("vistes/register.vista.php");
    }
}
