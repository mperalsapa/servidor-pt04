<?php
include_once("env.php");

$mux["/"] = "src/controllers/index.php";
$mux["/index"] = "src/controllers/index.php";
$mux["/login"] = "src/controllers/login.php";
$mux["/register"] = "src/controllers/register.php";
$mux["/logout"] = "src/controllers/logout.php";
$mux["/lost-password"] = "src/controllers/lost-password.php";
$mux["/loginCallback"] = "src/controllers/loginCallback.php";
$mux["/profile"] = "src/controllers/profile.php";
$mux["/webhook"] = "src/controllers/webhook.php";
$mux["/write"] = "src/controllers/write.php";
$mux["/twittercallback"] = "src/controllers/write.php";
$mux["/tos"] = "src/controllers/tos.php";
$mux["/privacy"] = "src/controllers/privacy.php";
$mux["/googleLogin"] = "src/controllers/loginCallback.php";
$mux["/githubLogin"] = "src/controllers/loginCallback.php";
$mux["/twitterLogin"] = "src/controllers/loginCallback.php";

function route(string $url, array $mux)
{
        if (isset($mux[$url])) {
                $controller = $mux[$url];
                include_once($controller);
                die();
        } else {
                include_once("src/internal/viewFunctions/browser.php");
                redirectClient("/");
        }
}

$parsedUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (!isset($baseUrl)) {
        route($parsedUri, $mux, $baseUrl);
}
if (empty($baseUrl) || $baseUrl == "/") {
        route($parsedUri, $mux, $baseUrl);
}

$parsedUri = "/" . str_replace($baseUrl, "", $parsedUri);
route($parsedUri, $mux);
