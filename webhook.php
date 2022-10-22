<?php
# webhook for project deployment
if ($_GET["token"] == "WH9teDg98ppm2GjyxyYtgwbee563Cbgddv5tmuyX") {
    // $cmd = shell_exec("find . -not \( -name 'webhook.php' -or -name 'env.php' \) -exec rm -r '{}' && git clone https://github.com/mperalsapa/servidor-pt04.git && rm -rf servidor-pt04/.git && mv servidor-pt04/* .");
    $cmd = shell_exec("git pull");

    echo $cmd;
    echo 'Deployment sucess';
} else {
    echo 'Error';
}
