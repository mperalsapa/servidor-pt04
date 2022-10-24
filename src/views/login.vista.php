<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessió</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
</head>

<body>
    <div class="bg-dark d-flex flex-column align-items-center justify-content-center" style="height:100vh;">
        <a class="m-4 d-flex align-items-center justify-content-center btn btn-secondary" href="<?= $baseUrl ?>">
            <h2 class="text-white m-0"><i class="bi bi-house"></i> ARTICLES DE PELICULES</h2>
        </a>
        <div class="bg-white rounded col-8 col-md-6 col-lg-5 col-xxl-3">
            <form class="align-middle m-4" action="login" method="POST">
                <h2>Iniciar Sessió</h2>
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
                <div class="mt-3">
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
                    <div class="">
                        <button type="submit" class="btn btn-primary col-12"><i class="bi bi-send"></i> Iniciar Sessió</button>
                    </div>
                </div>
            </form>
            <hr class="hr m-4" />
            <div class="mx-4">

                <div class="d-flex flex">
                    <a class="btn btn-secondary col" href="registre"><i class="bi bi-clipboard-minus"></i> Registre</a>
                    <a class="btn btn-secondary col ms-2" href="lost-password"><i class="bi bi-question-octagon"></i> Recuperar Contrasenya</a>
                </div>
            </div>
            <hr class="hr m-4" />
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed p-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Social
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <div class=" m-4 d-grid gap-3">
                                <a class="d-flex justify-content-center align-items-center border btn btn-primary py-3 " href="login?socialLogin=google">
                                    <i class="bi bi-google"></i>
                                    <p class="m-0 ms-3">Google</p>
                                </a>
                                <a class="d-flex justify-content-center align-items-center border btn btn-dark py-3 " href="login?socialLogin=github">
                                    <i class="bi bi-github"></i>
                                    <p class="m-0 ms-3">Github</p>
                                </a>
                                <a class="d-flex justify-content-center align-items-center border btn btn-info py-3 " href="login?socialLogin=twitter">
                                    <i class="bi bi-twitter"></i>
                                    <p class="m-0 ms-3">Twitter</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/bodyEnd.php"); ?>
</body>

</html>