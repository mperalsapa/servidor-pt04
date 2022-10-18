<!DOCTYPE html>
<html lang="en">
<!-- Marc Peral DAW 2 -->

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<?php include_once("internal/vistes/header.php"); ?>
	<title>Paginació</title>
</head>

<body class="bg-dark">

	<div class="contenidor container bg-white border border-dark rounded">
		<div class="d-flex justify-content-between px-4 pt-4">
			<h1 class=>Articles</h1>
			<div class="btn-group dropstart">
				<button type="button" class="btn <?php echo checkLogin() ? "btn-primary" : "btn-secondary" ?> btn-sm rounded-circle m-0 p-0 " style="width: 3rem; height: 3rem;" data-bs-toggle="dropdown" aria-expanded="false">
					<?php
					if (checkLogin()) {
						$nameInitial = $_SESSION['name-initial'];
						$surnameInitial = $_SESSION['surname-initial'];

						echo "<span class=\"my-0\">$nameInitial$surnameInitial</span>";
					} else {
						echo "<i class=\"bi bi-person-fill\"></i>";
					}


					?>
				</button>
				<ul class="dropdown-menu">
					<?php if (!checkLogin()) {
						echo "<li><a class=\"dropdown-item\" href=\"login.php\"><i class=\"bi bi-box-arrow-in-right\"></i> Iniciar Sessió</a></li>";
						echo "<li><a class=\"dropdown-item\" href=\"register.php\"><i class=\"bi bi-clipboard-minus\"></i> Registrarse</a></li>";
					} else {
						echo "<li><a class=\"dropdown-item\" href=\"logout.php\"><i class=\"bi bi-box-arrow-right\"></i> Tancar sesió</a></li>";
					} ?>

				</ul>
			</div>
		</div>
		<section class="articles">
			<?php
			include_once('internal/vistes/articles.php');
			printArticlesbyUserId($articles);
			?>
		</section>

		<?php
		printPagination($page, 1, $maxPage, 6)
		?>
	</div>
	<?php include_once('internal/vistes/body_end.php'); ?>
</body>

</html>