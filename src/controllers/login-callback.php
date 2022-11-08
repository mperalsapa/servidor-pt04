<?php
// Marc Peral
// script que s'encarrega de la crida del callback de login social

// importem les funcions necessaries
include_once("src/internal/viewFunctions/social-login.php");
include_once("src/internal/viewFunctions/browser.php");
include("env.php");

// agafem la url per seleccionar el tipus d'autenticacio
$authProvider = getPathOverBase();
//debug
echo "<br>" . $authProvider . "<br>";
echo "Login method:";

//
switch ($authProvider) {
    case '/google-login':
        echo "google";
        $userInfo = getGoogleProfile($googleClientID, $googleClientSecret, $callbackUrl);
        break;
    case '/github-login':
        echo "github";
        $userInfo = getGithubProfile($githubClientID, $githubClientSecret, $callbackUrl);
        break;
    case '/twitter-login':
        echo "twitter";
        $userInfo = getTwitterProfile($twitterClientID, $twitterClientSecret, $callbackUrl);
        break;
}



if (!empty($userInfo)) {
    print_r($userInfo);
    socialLoginUser($userInfo);
}

// redirectClient("login");
