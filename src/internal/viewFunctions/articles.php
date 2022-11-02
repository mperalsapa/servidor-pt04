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
            echo "<div>" . $row["nom"] . " " . $row["cognoms"] . " - " . $row["data"] . "</div>";
            if (isset($userId)) {
                if ($userId == $row["autor"]) {
                    echo "<div class=\"mt-3\">";
                    echo "<a class=\"btn btn-sm btn-outline-primary me-3\" href=\"write-article?id=" . $row["id"] . "\"><i class=\"bi bi-pencil\"></i> Editar</a>";
                    echo "
                        <div class=\"modal fade\" id=\"articleDelete\" tabindex=\"-1\" aria-labelledby=\"articleDeleteLabel\" aria-hidden=\"true\">
                            <div class=\"modal-dialog\">
                                <div class=\"modal-content\">
                                    <div class=\"modal-header\">
                                        <h5 class=\"modal-title\" id=\"articleDeleteLabel\">Esborrar Article</h5>
                                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                    </div>
                                    <div class=\"modal-body\">
                                        Estas segur que vols esborrar aquest article? No es podra recuperar una vegada esborrat!
                                    </div>
                                    <div class=\"modal-footer\">
                                        <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Cancel·lar</button>
                                        <a class=\"btn btn-danger \" href=\"delete-article?id=" . $row["id"] . "\"><i class=\"bi bi-trash\"></i> Esborrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    echo "<button type=\"button\" class=\"btn btn-sm btn-outline-danger\" data-bs-toggle=\"modal\" data-bs-target=\"#articleDelete\">
                            <i class=\"bi bi-trash\"></i> Esborrar
                        </button>";
                    echo "</div>";
                }
            }
            echo "</div>";
        }
    } else {
        echo "<div class=\" border border-dark m-4 p-4 rounded  \">";
        echo "<p>";
        echo "No hi ha articles disponibles. Pots afegir un article aqui: <a href=write> Afegir article</a>";
        echo "</p>";
        echo "</div>";
    }
};
