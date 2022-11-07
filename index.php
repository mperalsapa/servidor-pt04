<?php
include_once("env.php");

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

$mux["/"] = "src/controllers/index.php";
$mux["/index"] = "src/controllers/index.php";
$mux["/login"] = "src/controllers/login.php";
$mux["/register"] = "src/controllers/register.php";
$mux["/logout"] = "src/controllers/logout.php";
$mux["/lost-password"] = "src/controllers/lost-password.php";
$mux["/login-callback"] = "src/controllers/login-callback.php";
$mux["/profile"] = "src/controllers/profile.php";
$mux["/change-email"] = "src/controllers/change-profile.php";
$mux["/change-password"] = "src/controllers/change-profile.php";
$mux["/delete-account"] = "src/controllers/delete-profile.php";
$mux["/webhook"] = "src/controllers/webhook.php";
$mux["/write-article"] = "src/controllers/write-article.php";
$mux["/delete-article"] = "src/controllers/delete-article.php";
$mux["/tos"] = "src/controllers/tos.php";
$mux["/privacy"] = "src/controllers/privacy.php";
$mux["/contact"] = "src/controllers/contact.php";
$mux["/google-login"] = "src/controllers/login-callback.php";
$mux["/github-login"] = "src/controllers/login-callback.php";
$mux["/twitter-login"] = "src/controllers/login-callback.php";

include_once("src/internal/viewFunctions/git.php");
$version = getCurrentGitCommit("main");
printGitInfo($version);

$parsedUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (!isset($baseUrl)) {
        route($parsedUri, $mux, $baseUrl);
}
if (empty($baseUrl) || $baseUrl == "/") {
        route($parsedUri, $mux, $baseUrl);
}

$parsedUri = "/" . str_replace($baseUrl, "", $parsedUri);
route($parsedUri, $mux);
