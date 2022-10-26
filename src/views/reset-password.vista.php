<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contrasenya</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <a class="my-4 d-flex align-items-center justify-content-center btn btn-secondary col-10 col-md-8 col-lg-6 col-xxl-4" href="index">
            <span class="text-white m-0 fs-5"><i class="bi bi-house"></i> ARTICLES DE PEL·LÍCULES</span>
        </a>
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="lost-password?resetToken=<?= $token ?>" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item"><a href="lost-password">Recuperar Contrasenya</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Canviar Contrasenya</li>
                    </ol>
                </nav>
                <h2>Restablir Contrasenya</h2>
                <div class="row mt-2">
                    <label>Contrasenya
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contrasenya">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">
                    <label>Verificacio Contrasenya
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-check-all"></i></span>
                            </div>
                            <input type="password" class="form-control" id="verify-password" name="verify-password" placeholder="Contrasenya">
                        </div>
                    </label>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary col-12"><i class="bi bi-send"></i> Enviar</button>
                </div>
            </form>
        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/bodyEnd.php"); ?>
</body>

</html>