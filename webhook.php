<?php

# webhook for project deployment
include("env.php");

function returnError(string $msg)
{
    echo $msg;
    http_response_code(400);
    die();
}
if (empty($_GET["token"]) || $_GET["token"] != $webhookToken) {
    returnError("Invalid Token");
}

$payload = $_POST;
if (empty($payload["payload"])) {
    returnError("Payload is empty");
}
$payload = json_decode($payload["payload"]);
if (empty($payload->ref)) {
    returnError("Wrong Payload");
}

$branch = $payload->ref;
$branch = str_replace("refs/heads/", "", $branch);
if ($branch != "main") {
    echo "This push is not provided to main. Skipping...";
    http_response_code(200);
    die();
}

$cmd = shell_exec("git pull");
echo $cmd;
echo 'Deployment sucess';
