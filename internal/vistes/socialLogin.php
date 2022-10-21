<?php

include_once("hybridAuth/autoload.php");


function googleLogin(string $googleClientID, string $googleClientSecret): \Hybridauth\Provider\Google
{
    include_once("env.php");
    $config = [
        'callback' => $callbackUrl . 'Google', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        'keys' => ['id' => $googleClientID, 'secret' => $googleClientSecret], // Your Github application credentials
    ];
    $googleAuth = new \Hybridauth\Provider\Google($config);
    $googleAuth->authenticate();
    return $googleAuth;
}

function getGoogleProfile(string $googleClientID, string $googleClientSecret): array
{
    $googleAuth = googleLogin($googleClientID, $googleClientSecret);
    $googleAuth->authenticate();
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

function githubLogin(string $githubClientID, string $githubClientSecret): \Hybridauth\Provider\GitHub
{
    include_once("env.php");
    $config = [
        'callback' => $callbackUrl . 'GitHub', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        'keys' => ['id' => $githubClientID, 'secret' => $githubClientSecret], // Your Github application credentials
        'curl_options' => [
            CURLOPT_USERAGENT => 'mperalsapa'
        ]
    ];
    $github = new Hybridauth\Provider\GitHub($config);
    $github->authenticate();
    return $github;
}

function getGithubProfile(string $githubClientID, string $githubClientSecret): array
{
    $github = githubLogin($githubClientID, $githubClientSecret);
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


function socialLoginUser(array $userInfo)
{
    include_once("internal/db/mysql.php");
    include_once("internal/db/session_manager.php");
    include_once("internal/vistes/browser.php");
    $pdo = getMysqlPDO();
    if (userExists($pdo, $userInfo["email"])) {
        setUserLoggedinData($pdo, $userInfo["email"]);
        redirectClient("index.php");
        die();
    }

    $register = addUser($pdo, $userInfo["name"], $userInfo["surname"], $userInfo["email"], "");
    if ($register) {
        setUserLoggedinData($pdo, $userInfo["email"]);
        redirectClient("index.php");
        die();
    }
}
