<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canviar Correu Electrónic</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <a class="my-4 d-flex align-items-center justify-content-center btn btn-secondary col-10 col-md-8 col-lg-6 col-xxl-4" href="index">
            <span class="text-white m-0 fs-5"><i class="bi bi-house"></i> ARTICLES DE PEL·LÍCULES</span>
        </a>
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="lost-password" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item"><a href="profile">Perfil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Canviar Correu Electrónic</li>
                    </ol>
                </nav>
                <?php
                if (!empty($alertMessage)) {
                    echo "<div class=\"alert alert-$alertType\" role=\"alert\">$alertIcon $alertMessage</div>";
                }
                ?>
            </form>

        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>