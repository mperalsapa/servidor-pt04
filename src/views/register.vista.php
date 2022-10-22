<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <title>Registre</title>
</head>

<body>
    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <form class="h-50 align-middle m-4" action="register.php" method="POST">
                <div class="row">
                    <div class="col">
                        <label>Nom

                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo isset($name) ? $name : '' ?>">
                        </label>
                    </div>
                    <div class="col">
                        <label>Cognoms

                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cognoms" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                        </label>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label>Correu Electronic

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Correu Electronic" value="<?php echo isset($email) ? $email : '' ?>">
                            </div>
                        </label>
                    </div>
                    <div class="col">
                        <label>Verificacio Correu Electronic

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-check-all"></i></span>
                                </div>
                                <input type="email" class="form-control" id="verify-email" name="verify-email" placeholder="Correu Electronic">
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label>Contrasenya

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contrasenya">
                            </div>
                        </label>
                    </div>
                    <div class="col">
                        <label>Verificacio Contrasenya

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-check-all"></i></span>
                                </div>
                                <input type="password" class="form-control" id="verify-password" name="verify-password" placeholder="Contrasenya">
                            </div>
                        </label>
                    </div>
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
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-pen"></i> Registrar</button>
                            <a class="ms-3" href="login.php">Iniciar Sessió</a>
                        </div>
                        <a href="index.php" class="btn btn-secondary"><i class="bi bi-house"></i> Inici</a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php include_once("src/internal/viewFunctions/bodyEnd.php"); ?>
</body>

</html>