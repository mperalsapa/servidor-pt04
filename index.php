<?php

$mux["/"] = "src/controllers/index.php";
$mux["/index"] = "src/controllers/index.php";
$mux["/login"] = "src/controllers/login.php";
$mux["/loginCallback"] = "src/controllers/loginCallback.php";
$mux["/logout"] = "src/controllers/logout.php";
$mux["/profile"] = "src/controllers/profile.php";
$mux["/register"] = "src/controllers/register.php";
$mux["/webhook"] = "src/controllers/webhook.php";
$mux["/write"] = "src/controllers/write.php";


$parsedUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
if (isset($mux[$parsedUri])) {
        $controller = $mux[$parsedUri];
        include_once($controller);
} else {
        include_once("src/internal/viewFunctions/browser.php");
        redirectClient("/");
}