<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $viewData["formTitle"] ?></title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body>

    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-10 col-md-8 col-lg-8 col-xxl-8">
            <form class="h-50 align-middle m-4" action="write-article<?php echo $viewData["id"] ? "?id=" . $viewData["id"] : "" ?>" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $viewData["formTitle"] ?></li>
                    </ol>
                </nav>
                <h1><?= $viewData["formTitle"] ?></h1>
                <div class="form-group">
                    <label for="article">Article</label>
                    <textarea class="form-control" name="article" id="article" rows="10"><?= $viewData["article"] ?></textarea>
                </div>
                <div class="col-5 col-md-4 col-lg-3 col-xxl-2">

                    <label for="article-date">Data</label>
                    <input class="form-control" name="article-date" id="article-date" type="date" value=<?= $viewData["date"] ?>>
                </div>
                <div class="mt-4">
                    <?php
                    if (!empty($alertMessage)) {
                        echo "<div class=\"alert alert-$alertType\" role=\"alert\">$alertIcon $alertMessage</div>";
                    }
                    ?>
                    <di>
                        <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-send"></i> <?= $viewData["formSubmitButton"] ?> </button>
                        <a class="btn btn-danger <?php echo !empty($viewData["canDelete"]) ? "" : "visually-hidden" ?>" href="delete-article?id=<?= $viewData["id"] ?>"> <i class="bi bi-trash"></i> Esborrar</a>
                </div>
        </div>
        </form>
    </div>
    </div>

    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>