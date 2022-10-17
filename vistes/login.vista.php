<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar-se</title>
    <?php include_once("internal/vistes/header.php"); ?>
</head>

<body>
    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-8 col-md-5 col-lg-4  col-xxl-3">
            <form class="h-50 align-middle m-4 <?php echo isset($invalidForm) ? 'was-validated' : '' ?>" action="login.php" method="POST">
                <div class="form-group">
                    <label for="">Correu Electronic</label>
                    <input type="email" class="form-control" name="email" placeholder="Correu Electronic" required value="<?php echo isset($email) ? $email : '' ?>">
                    <div class="invalid-feedback">Introdueix un correu electronic valid</div>
                </div>
                <div class="form-group mt-4">
                    <label for="">Contrasenya</label>
                    <input type="password" class="form-control" name="password" placeholder="Contrasenya" required>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>