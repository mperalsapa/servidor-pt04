<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre complet</title>
    <?php include_once("internal/vistes/header.php"); ?>
</head>

<body style="height:100vh;">
    <div class="container text-center d-flex align-items-center" style="height:100%;">
        <div style="width:100%;">
            <h1 class="" style="width:100%;">S'ha completat l'inici de sessio.</h1>
            <p>Redirigint a l'inici en 5 segons...</p>
            <p>Si no et redirigeix, fes clic <a href="index.php">aqui</a></p>
        </div>
    </div>
    <?php header("refresh:5;url=index.php"); ?>
    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>