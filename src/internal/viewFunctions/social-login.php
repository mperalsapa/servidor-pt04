<?php

include_once("src/internal/hybridAuth/autoload.php");


function googleLogin(string $googleClientID, string $googleClientSecret, string $callbackUrl): \Hybridauth\Provider\Google
{
    $config = [
        'callback' => $callbackUrl . '/google-login', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        'keys' => ['id' => $googleClientID, 'secret' => $googleClientSecret], // Your Github application credentials
    ];
    var_dump($config);
    $googleAuth = new \Hybridauth\Provider\Google($config);
    $googleAuth->authenticate();
    return $googleAuth;
}

function getGoogleProfile(string $googleClientID, string $googleClientSecret, string $callbackUrl): array
{
    $googleAuth = googleLogin($googleClientID, $googleClientSecret, $callbackUrl);
    try {
        if ($googleAuth->authenticate("Google")) {
            $userProfile = $googleAuth->getUserProfile();
            $userInfo["email"] = $userProfile->email;
            if (empty($userProfile->firstName)) {
                $userInfo["name"] = $userProfile->displayName;
            } else {
                $userInfo["name"] = $userProfile->firstName;
            }
            $userInfo["surname"] = $userProfile->lastName;
        } else {
            die();
        }
    } catch (Hybridauth\Exception\HttpClientFailureException $e) {
        echo 'Curl text error message : ' . $googleAuth->getHttpClient()->getResponseClientError();
    } catch (\Exception $e) {
        echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
    }

    $googleAuth->disconnect();
    return $userInfo;
}

function githubLogin(string $githubClientID, string $githubClientSecret, string $callbackUrl): \Hybridauth\Provider\GitHub
{
    $config = [
        'callback' => $callbackUrl . '/github-login', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        'keys' => ['id' => $githubClientID, 'secret' => $githubClientSecret], // Your Github application credentials
        'curl_options' => [
            CURLOPT_USERAGENT => 'mperalsapa'
        ]
    ];
    $github = new Hybridauth\Provider\GitHub($config);
    $github->authenticate();
    return $github;
}

function getGithubProfile(string $githubClientID, string $githubClientSecret, string $callbackUrl): array
{
    $github = githubLogin($githubClientID, $githubClientSecret, $callbackUrl);
    try {
        if ($github->authenticate("GitHub")) {
            $userProfile = $github->getUserProfile();
            $userInfo["email"] = $userProfile->email;
            if (empty($userProfile->firstName)) {
                $userInfo["name"] = $userProfile->displayName;
            } else {
                $userInfo["name"] = $userProfile->firstName;
            }
            $userInfo["surname"] = $userProfile->lastName;
        } else {
            die();
        }
    } catch (Hybridauth\Exception\HttpClientFailureException $e) {
        echo 'Curl text error message : ' . $github->getHttpClient()->getResponseClientError();
    } catch (\Exception $e) {
        echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
    }
    $github->disconnect();
    return $userInfo;
}

function twitterLogin(string $twitterClientID, string $twitterClientSecret, string $callbackUrl): \Hybridauth\Provider\Twitter
{
    $config = [
        'callback' => $callbackUrl . '/twitter-login', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        "enabled" => true,
        'keys' => ['key' => $twitterClientID, 'secret' => $twitterClientSecret] // Your Github application credentials
    ];
    $twitter = new Hybridauth\Provider\Twitter($config);
    $twitter->authenticate();
    return $twitter;
}

function getTwitterProfile(string $twitterClientID, string $twitterClientSecret, string $callbackUrl): array
{
    $twitter = twitterLogin($twitterClientID, $twitterClientSecret, $callbackUrl);
    try {
        if ($twitter->authenticate("Twitter")) {
            $userProfile = $twitter->getUserProfile();
            $userInfo["email"] = $userProfile->email;
            if (empty($userProfile->firstName)) {
                $userInfo["name"] = $userProfile->displayName;
            } else {
                $userInfo["name"] = $userProfile->firstName;
            }
            $userInfo["surname"] = $userProfile->lastName;
        } else {
            die();
        }
    } catch (Hybridauth\Exception\HttpClientFailureException $e) {
        echo 'Curl text error message : ' . $twitter->getHttpClient()->getResponseClientError();
    } catch (\Exception $e) {
        echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
    }
    $twitter->disconnect();
    return $userInfo;
}

function socialLoginUser(array $userInfo)
{
    include_once("src/internal/db/mysql.php");
    include_once("src/internal/db/session_manager.php");
    include_once("src/internal/viewFunctions/browser.php");
    $pdo = getMysqlPDO();
    if (userExists($pdo, $userInfo["email"])) {
        setUserLoggedinData($pdo, $userInfo["email"]);
        redirectClient("/");
        die();
    }

    $register = addUser($pdo, $userInfo["name"], $userInfo["surname"], $userInfo["email"], "");
    if ($register) {
        setUserLoggedinData($pdo, $userInfo["email"]);
        redirectClient("/");
        die();
    }
}
