<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contrasenya</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
</head>

<body class="m-0 p-0 bg-dark">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <a class="my-4 d-flex align-items-center justify-content-center btn btn-secondary col-12 col-sm-8 col-md-6 col-lg-5 col-xxl-3" href="index">
            <span class="text-white m-0 fs-5"><i class="bi bi-house"></i> ARTICLES DE PEL·LÍCULES</span>
        </a>
        <div class="bg-white rounded col-8 col-md-6 col-lg-5 col-xxl-3">
            <form class="align-middle m-4" action="lost-password" method="POST">
                <h2>Recuperar Contrasenya</h2>
                <div class="form-group">
                    <label for="email">Correu Electronic</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Correu Electronic" id="email" required value="<?php echo isset($email) ? $email : '' ?>">
                    </div>
                    <div class="invalid-feedback">Introdueix un correu electronic valid</div>
                </div>
                <div class="mt-3">
                    <?php if (!empty($formResult)) {
                        echo "<div class=\"d-flex\">";
                        echo "<p class=\"bg-danger py-2 px-3 border rounded text-white\">";
                        echo $formResult;
                        echo "</p>";
                        echo "</div>";
                    }
                    ?>
                    <label>Captcha</label>
                    <div class="h-captcha" data-sitekey="4d7d3404-e41b-4616-8035-8fd9b72cca7b"></div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary col-12"><i class="bi bi-send"></i> Enviar</button>
                    </div>
                </div>
            </form>
            <hr class="hr m-4" />
            <div class="m-4">

                <div class="d-flex flex">
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center" href="login"><i class="me-2 bi bi-box-arrow-in-right"></i> Iniciar Sessió</a>
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center ms-2" href="register"><i class="me-2 bi bi-clipboard-minus"></i> Registre</a>
                </div>
            </div>

        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/bodyEnd.php"); ?>
</body>

</html>