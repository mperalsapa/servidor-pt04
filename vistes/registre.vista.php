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
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                        <form action="registre.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="nom" class="form-control form-control-lg" value="<?php echo isset($name) ? $name : '' ?>" />
                                        <label class="form-label" for="nom">Nom</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="cognom" class="form-control form-control-lg" value="<?php echo isset($lastname) ? $lastname : '' ?>" />
                                        <label class="form-label" for="cognom">Cognoms</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="email" name="correu" class="form-control form-control-lg" value="<?php echo isset($email) ? $email : '' ?>" />
                                        <label class="form-label" for="correu">Correu Electronic</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="email" name="correu-2" class="form-control form-control-lg" />
                                        <label class="form-label" for="correu-2">Correu Electronic</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="password" name="contrasenya" class="form-control form-control-lg" />
                                        <label class="form-label" for="contrasenya">Contrassenya</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="password" name="contrasenya-2" class="form-control form-control-lg" />
                                        <label class="form-label" for="contrasenya">Contrassenya</label>
                                    </div>
                                </div>
                            </div>
                            <p><?php echo isset($missatgeForm) ? $missatgeForm : '' ?></p>
                            <div class="mt-4 pt-2">
                                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>