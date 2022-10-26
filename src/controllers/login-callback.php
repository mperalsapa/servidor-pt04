<?php


echo "callback site\n";
include_once("src/internal/viewFunctions/social-login.php");
include_once("src/internal/viewFunctions/browser.php");
include("env.php");


$authProvider = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
echo "<br>" . $authProvider . "<br>";
echo "Login method:";
switch ($authProvider) {
    case '/googleLogin':
        echo "google";
        $userInfo = getGoogleProfile($googleClientID, $googleClientSecret, $callbackUrl);
        break;
    case '/githubLogin':
        echo "github";
        $userInfo = getGithubProfile($githubClientID, $githubClientSecret, $callbackUrl);
        break;
    case '/twitterLogin':
        echo "twitter";
        $userInfo = getTwitterProfile($twitterClientID, $twitterClientSecret, $callbackUrl);
        break;
}


print_r($userInfo);

if (!empty($userInfo)) {
    socialLoginUser($userInfo);
}

// redirectClient("login");
