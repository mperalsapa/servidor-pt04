<?php
include_once("internal/db/mysql.php");
include_once("internal/db/session_manager.php");
include_once("internal/vistes/browser.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (checkLogin()) {
        redirectClient("index.php");
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
        include_once("vistes/register.vista.php");
        die();
    }
    if (empty($lastname)) {
        $formResult = "El camp Cognom es buit";
        include_once("vistes/register.vista.php");
        die();
    }
    if (empty($email)) {
        $formResult = "El camp Email es buit";
        include_once("vistes/register.vista.php");
        die();
    }
    if (empty($email2)) {
        $formResult = "La verificacio de correu es buida";
        include_once("vistes/register.vista.php");
        die();
    }
    if (empty($password)) {
        $formResult = "El camp Contrassenya es buit";
        include_once("vistes/register.vista.php");
        die();
    }
    if (empty($password2)) {
        $formResult = "La verificacio de contrasenya es buida";
        include_once("vistes/register.vista.php");
        die();
    }

    if ($email != $email2) {
        $formResult = "El correu i la verificacio no coincideixen";
        include_once("vistes/register.vista.php");
        die();
    }
    if ($password != $password2) {
        $formResult = "La contrasenya i la verificacio no coincideixen";
        include_once("vistes/register.vista.php");
        die();
    }

    $pdo = getMysqlPDO();
    if (userExists($pdo, $email)) {
        $formResult = "Aquest correu ja pertany a un compte. Si no recordes la contrasenya, fes una recuperació aqui: <a href=\"lost-password.php\">Recuperació de contrasenya</a>";
        include_once("vistes/register.vista.php");
        die();
    };

    $insertsuccess = addUser($pdo, $name, $lastname, $email, $password);
    if ($insertsuccess) {
        include_once("vistes/register.succ.vista.php");
        setLoggedin(true);
    } else {
        $formResult = "S'ha produit un error a l'hora de realitzar el register. Intenta-ho un altre cop.";
        include_once("vistes/register.vista.php");
    }
}
