<?php
function printArticlesbyUserId($articles)
{
    if (isset($articles) && $articles != '') {
        while ($row = $articles->fetch()) {
            echo "<div class=\" border border-dark m-4 p-4 rounded  \">";
            echo "<p>";
            echo $row["article"];
            echo "</p>";
            echo "<div>- Autor, 01/01/2000</div>";
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
