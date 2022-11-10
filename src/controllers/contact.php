<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacte</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark">
    <?php
    // mostrem navbar
    include_once("src/internal/viewFunctions/navbar.php");
    ?>

    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="card m-4" style="width: 18rem;">
            <img src="data:image/jpeg;base64,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" class="card-img-top" alt="Imatge de perfil en el moodle del Sa Palomera">
            <div class="card-body">
                <h5 class="card-title">Contacte</h5>
                <p class="card-text"> Per qualsevol consulta, pots contactar amb mi a la seguent direccio de correu electronic: <span>m.peral</span><span>@sapalomera.cat</span>
                </p>
                <a class="btn btn-primary" href="mailto:m.peral@sapalomera.cat"><i class="bi bi-envelope"></i> Enviar correu</a>
            </div>
        </div>
    </div>

    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>