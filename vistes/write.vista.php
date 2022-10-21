<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $formTitle ?></title>
    <?php include_once("internal/vistes/header.php"); ?>
</head>

<body>

    <div class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh; width:100vw;">
        <div class="bg-white rounded col-10 col-md-8 col-lg-8 col-xxl-8">
            <form class="h-50 align-middle m-4" action="write.php<?php echo $articleId != 0 ? "?id=$articleId" : "" ?>" method="POST">
                <h1><?= $formTitle ?></h1>
                <div class="form-group">
                    <label for="article">Article</label>
                    <textarea class="form-control" name="article" id="article" rows="10"><?= $article ?></textarea>
                </div>
                <div class="col-5 col-md-4 col-lg-3 col-xxl-2">

                    <label for="article-date">Data</label>
                    <input class="form-control" name="article-date" id="article-date" type="date" value=<?= $date ?>>
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
                            <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-send"></i> <?= $formSubmitButton ?> </button>
                            <a class="btn btn-danger <?php echo isset($formCanDelete) ? "" : "visually-hidden" ?>" href="delete.php?id=<?= $articleId ?>"> <i class="bi bi-trash"></i> Esborrar</a>
                        </div>
                        <a class="btn btn-secondary" href="index.php"><i class="bi bi-house"></i> Inici</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include_once("internal/vistes/body_end.php"); ?>
</body>

</html>