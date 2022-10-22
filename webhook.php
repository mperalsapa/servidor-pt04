<?php
# webhook for project deployment
if ($_GET["token"] == "WH9teDg98ppm2GjyxyYtgwbee563Cbgddv5tmuyX") {
$cmd = shell_exec("find . -not \( -name 'webhook.php' -or -name 'env.php' \) -delete && git clone https://github.com/mperalsapa/servidor-pt04.git && rm -rf servidor-pt04/.git && mv servidor-pt04/* .");
echo $cmd;
echo 'Deployment sucess';
} else {
echo 'Error';
}

?>