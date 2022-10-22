<?php


echo "callback site\n";
include_once("src/internal/viewFunctions/socialLogin.php");
include_once("src/internal/viewFunctions/browser.php");
include("src/env.php");


if (!isset($_GET["hauth_done"])) {
    die();
}
$authProvider = $_GET["hauth_done"];

if (!isset($_GET["code"])) {
    die();
}
$authCode = $_GET["code"];

if (!isset($_GET["state"])) {
    die();
}
$authState = $_GET["state"];

switch ($authProvider) {
    case 'Google':
        $userInfo = getGoogleProfile($googleClientID, $googleClientSecret, $callbackUrl);
        break;
    case 'GitHub':
        $userInfo = getGithubProfile($githubClientID, $githubClientSecret, $callbackUrl);
        break;
}


if (!empty($userInfo)) {
    socialLoginUser($userInfo);
}

redirectClient("login");
