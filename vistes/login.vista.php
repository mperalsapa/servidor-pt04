<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar-se</title>
    <?php include_once("internal/vistes/header.php"); ?>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
</head>

<body>
    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-8 col-md-5 col-lg-4  col-xxl-3">
            <form class="h-50 align-middle m-4" action="login.php" method="POST">
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
                <div class="form-group mt-4">
                    <label for="password">Contrasenya</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Contrasenya" id="password" required>
                    </div>
                    <div class="invalid-feedback">Introdueix una contrasenya</div>
                </div>
                <div class="mt-4">
                    <div class="d-flex">
                        <?php if (!empty($formResult)) {
                            echo "<p class=\"bg-danger py-2 px-3 border rounded text-white\">";
                            echo $formResult;
                            echo "</p>";
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($_SESSION["login-attempts"])) {
                        if ($_SESSION["login-attempts"] > 2) {
                            echo "<label>Captcha</label>";
                            echo "<div class=\"h-captcha\" data-sitekey=\"4d7d3404-e41b-4616-8035-8fd9b72cca7b\"></div>";
                        }
                    }

                    ?>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Iniciar Sessió</button>
                        <a class="btn btn-secondary" href="index.php"><i class="bi bi-house"></i> Inici</a>

                    </div>
                </div>
            </form>
        </div>

    </div>
    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>