<?php
if (empty($redirectTitle)) {
    $redirectTitle = isset($_GET['redirect-title']) ? $_GET['redirect-title'] : 'S\'ha completat l\'acció.';
}
if (empty($redirectLocation)) {
    $redirectLocation = isset($_GET['redirect-location']) ? $_GET['redirect-location'] : 'Redirigint a l\'inici';
}
if (empty($redirectLink)) {
    $redirectLink = isset($_GET['redirect-link']) ? $_GET['redirect-link'] : 'index.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $redirectTitle ?></title>
    <?php include_once("internal/vistes/header.php"); ?>
</head>

<body style="height:100vh;">
    <div class="container text-center d-flex align-items-center" style="height:100%;">
        <div style="width:100%;">
            <h1 class="" style="width:100%;"><?php echo $redirectTitle ?></h1>
            <p>Redirigint a <?php echo $redirectLocation ?> en 5 segons...</p>
            <p>Si no et redirigeix, fes clic <a href="<?php echo $redirectLink ?>">aqui</a></p>
        </div>
    </div>
    <?php header("refresh:5;url=$redirectLink"); ?>
    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>