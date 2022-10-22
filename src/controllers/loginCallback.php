<?php


echo "callback site\n";
include_once("src/internal/viewFunctions/socialLogin.php");
include_once("src/internal/viewFunctions/browser.php");
include("src/env.php");


if (!isset($_GET["code"])) {
    die();
}
$authCode = $_GET["code"];

if (!isset($_GET["state"])) {
    die();
}
$authState = $_GET["state"];

$authProvider = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
switch ($authProvider) {
    case 'googleLogin':
        $userInfo = getGoogleProfile($googleClientID, $googleClientSecret, $callbackUrl);
        break;
    case 'gitHubLogin':
        $userInfo = getGithubProfile($githubClientID, $githubClientSecret, $callbackUrl);
        break;
    case 'twitterLogin':
        $userinfo = getTwitterProfile($twitterClientID, $twitterClientSecret, $callbackUrl);
        print_r($userinfo);
        die();
        break;
}


if (!empty($userInfo)) {
    socialLoginUser($userInfo);
}

redirectClient("login");
