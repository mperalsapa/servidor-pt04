<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body>
    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-8 col-md-6 col-lg-5 col-xxl-3">
            <div class="row col-12 d-flex justify-content-center m-0">
                <div class="col-3 m-5 bg-dark d-flex rounded-circle justify-content-center align-items-center" style="aspect-ratio: 1;">
                    <p class="m-0 text-white display-4">MP</p>
                </div>
            </div>
            <div class="row col-11 d-flex justify-content-center p-0 my-0 mx-auto">
                <p class="p-0 m-0 text-center display-6">Marc Jesús Peral Cajidos</p>
            </div>
            <div class="row col-8 d-flex justify-content-center align-items-center mx-auto mt-3 mb-5">
                <div class="row d-flex p-0 m-0">
                    <a class="btn btn-primary" href="changeEmail.php">Actualitzar Correu electronic</a>
                </div>
                <div class="row d-flex p-0 m-0 mt-3">
                    <a class="btn btn-primary" href="changePassword.php">Actualitzar Contrasenya</a>
                </div>
                <div class="row d-flex p-0 m-0 mt-3">
                    <a class="btn btn-warning" href="logout.php">Tancar Sessio</a>
                </div>
                <div class="row d-flex p-0 m-0 mt-5">
                    <a class="btn btn-danger" href="deleteAccount.php">Esborrar Compte</a>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("src/internal/viewFunctions/bodyEnd.php"); ?>
</body>

</html>