<?php
# webhook for project deployment
include("env.php");
if ($_GET["token"] == $webhookToken) {
    // $cmd = shell_exec("find . -not \( -name 'webhook.php' -or -name 'env.php' \) -exec rm -r '{}' && git clone https://github.com/mperalsapa/servidor-pt04.git && rm -rf servidor-pt04/.git && mv servidor-pt04/* .");
    $cmd = shell_exec("git pull");

    echo $cmd;
    echo 'Deployment sucess';
} else {
    echo 'Error';
}
