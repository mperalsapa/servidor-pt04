<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <title>Registre</title>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <a class="my-4 d-flex align-items-center justify-content-center btn btn-secondary col-12 col-sm-8 col-md-6 col-lg-5 col-xxl-3" href="index">
            <span class="text-white m-0 fs-5"><i class="bi bi-house"></i> ARTICLES DE PEL·LÍCULES</span>
        </a>
        <div class="bg-white rounded col-12 col-sm-8 col-md-6 col-lg-5 col-xxl-3">
            <form class="align-middle m-4" action="register" method="POST">
                <div class="row">
                    <label style="width:100%;">Nom
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo isset($name) ? $name : '' ?>">
                    </label>
                </div>
                <div class="row mt-2">
                    <label style="width:100%;">Cognoms
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cognoms" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                    </label>
                </div>

                <div class="row mt-2">
                    <label style="width:100%;">Correu Electronic
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correu Electronic" value="<?php echo isset($email) ? $email : '' ?>">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">
                    <label style="width:100%;">Verificacio Correu Electronic
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-check-all"></i></span>
                            </div>
                            <input type="email" class="form-control" id="verify-email" name="verify-email" placeholder="Correu Electronic">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">
                    <label style="width:100%;">Contrasenya
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contrasenya">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">

                    <label style="width:100%;">Verificacio Contrasenya

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-check-all"></i></span>
                            </div>
                            <input type="password" class="form-control" id="verify-password" name="verify-password" placeholder="Contrasenya">
                        </div>
                    </label>
                </div>
                <div class="mt-4">

                    <?php if (!empty($formResult)) {
                        echo "<div class=\"d-flex\">";
                        echo "<p class=\"bg-danger py-2 px-3 border rounded text-white\">";
                        echo $formResult;
                        echo "</p>";
                        echo "</div>";
                    }
                    ?>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary col"><i class="bi bi-pen"></i> Registrar</button>
                    </div>
                </div>
            </form>
            <hr class="hr m-4" />
            <div class="m-4">

                <div class="d-flex flex">
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center" href="login"><i class="me-2 bi bi-box-arrow-in-right"></i> Iniciar Sessió</a>
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center ms-2" href="lost-password"><i class="me-2 bi bi-question-octagon"></i> Recuperar Contrasenya</a>
                </div>
            </div>
        </div>

    </div>

    <?php include_once("src/internal/viewFunctions/bodyEnd.php"); ?>
</body>

</html>