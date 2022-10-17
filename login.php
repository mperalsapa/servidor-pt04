<?php
include_once("internal/db/mysql.php");
include_once("internal/db/session_manager.php");
include_once("internal/vistes/browser.php");


setInitials("Marc", "Peral");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (checkLogin()) {
        redirectClient("index.php");
    }
    include_once("vistes/login.vista.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    if (empty($email)) {
        $invalidForm = true;
    }

    $pdo = getMysqlPDO();
    if (!userExists($pdo, $email)) {
        $formResult = "El compte introduit no existeix. Si vols, et pots registrar aqui: <a href=\"register.php\">Registre</a>";
        include_once("vistes/login.vista.php");
        die();
    }

    if (!checkUserPassword($pdo, $password, $email)) {
        $formResult = "La contrasenya introduida no es correcte. Si no la recordes, fes una recuperació aqui: <a href=\"lost-password.php\">Recuperació de contrasenya</a>";
        include_once("vistes/login.vista.php");
        die();
    }

    $initials = getUserInitials($pdo, $email);

    setInitials($initials);

    setLoggedin(true);

    $redirectTitle = "Inici de sessio completat";
    $redirectLocation = "l'inici";
    $redirectLink = "index.php";

    include_once("vistes/redirect.vista.php");
}
