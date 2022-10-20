<?php


echo "callback site\n";
include_once("internal/vistes/socialLogin.php");
include_once("internal/vistes/browser.php");
include_once("env.php");


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
        $userInfo = getGoogleProfile($googleClientID, $googleClientSecret);
        break;
    case 'GitHub':
        $userInfo = getGithubProfile($githubClientID, $githubClientSecret);
        break;
}


if (!empty($userInfo)) {
    socialLoginUser($userInfo);
}

redirectClient("login.php");
