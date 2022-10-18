<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("internal/vistes/header.php"); ?>
    <title>Registre</title>
</head>

<body>
    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <form class="h-50 align-middle m-4" action="register.php" method="POST">
                <div class="row">
                    <div class="col">
                        <label for="">Nom</label>
                        <input type="text" class="form-control" name="name" placeholder="Nom" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>
                    <div class="col">
                        <label for="">Cognoms</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Cognoms" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="">Correu Electronic</label>
                        <input type="email" class="form-control" name="email" placeholder="Correu Electronic" value="<?php echo isset($email) ? $email : '' ?>">
                    </div>
                    <div class="col">
                        <label for="">Verificacio Correu Electronic</label>
                        <input type="email" class="form-control" name="verify-email" placeholder="Correu Electronic">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="">Contrasenya</label>
                        <input type="password" class="form-control" name="password" placeholder="Contrasenya">
                    </div>
                    <div class="col">
                        <label for="">Verificacio Contrasenya</label>
                        <input type="password" class="form-control" name="verify-password" placeholder="Contrasenya">
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

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="index.php" class="btn btn-secondary"><i class="bi bi-house"></i> Tornar a l'inici</a>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>