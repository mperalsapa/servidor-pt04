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
				<button type="button" class="btn btn-secondary btn-sm rounded-circle m-0 px-4 " data-bs-toggle="dropdown" aria-expanded="false">
					<?php
					// require_once()
					if (checkLogin()) {
						$nameInitial = $_SESSION['name-initial'];
						$surnameInitial = $_SESSION['surname-initial'];

						echo "<span class=\"my-0\">$nameInitial$surnameInitial</span>";
					} else {
						echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person p-0 m-0\" viewBox=\"0 0 16 16\">
						<path d=\"M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z\" />
					</svg>";
					}


					?>
				</button>
				<ul class="dropdown-menu">
					<?php if (!checkLogin()) {
						echo "<li><a class=\"dropdown-item\" href=\"login.php\">Iniciar Sessió</a></li>";
						echo "<li><a class=\"dropdown-item\" href=\"register.php\">Registrarse</a></li>";
					} else {
						echo "<li><a class=\"dropdown-item\" href=\"logout.php\">Tancar sesió</a></li>";
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