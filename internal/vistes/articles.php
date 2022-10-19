<?php
function printArticlesbyUserId($articles)
{
    if (isset($articles) && $articles != '') {
        if (isset($_SESSION["id"])) {
            $userId = $_SESSION["id"];
        }
        while ($row = $articles->fetch()) {
            echo "<div class=\" border border-dark m-4 p-4 rounded  \">";
            echo "<p>";
            echo $row["article"];
            echo "</p>";
            echo "<div>" . $row["Nom"] . " - " . $row["data"] . "</div>";
            if (isset($userId)) {
                if ($userId == $row["autor"]) {
                    echo "<a class=\"btn btn-sm btn-outline-primary mt-3\" href=\"write.php?id=" . $row["id"] . "\"><i class=\"bi bi-pencil\"></i> Editar</a>";
                }
            }
            echo "</div>";
        }
    } else {
        echo "<div class=\" border border-dark m-4 p-4 rounded  \">";
        echo "<p>";
        echo "No hi ha articles disponibles. Pots afegir un article aqui: <a href=write.php> Afegir article</a>";
        echo "</p>";
        echo "</div>";
    }
};
