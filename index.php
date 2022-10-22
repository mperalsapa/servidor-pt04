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
$mux["/twittercallback"] = "src/controllers/write.php";
$mux["/tos"] = "src/controllers/tos.php";
$mux["/privacy"] = "src/controllers/privacy.php";
$mux["/googleLogin"] = "src/controllers/loginCallback.php";
$mux["/githubLogin"] = "src/controllers/loginCallback.php";
$mux["/twitterLogin"] = "src/controllers/loginCallback.php";


$parsedUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
if (isset($mux[$parsedUri])) {
        $controller = $mux[$parsedUri];
        include_once($controller);
} else {
        include_once("src/internal/viewFunctions/browser.php");
        redirectClient("/");
}
