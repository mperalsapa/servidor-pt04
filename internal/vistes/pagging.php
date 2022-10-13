<?php
// Marc Peral 2 DAW

// aquesta funcio, agafa de la base de dades el numero d'articles que hi ha a la base de dades
// fa un calcul en base a un parametre, i retorna el numero maxim de pagines segons el numero d'articles
// que volem per pagina
function checkMaxPage(PDO $conn, int $itemsPerPage): int
{
    if (empty($itemsPerPage) || $itemsPerPage < 1) {
        $itemsPerPage = 3;
    }
    $pdo = $conn->prepare('SELECT count(*) as count FROM article');
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    $count = ceil($count / $itemsPerPage);
    return $count;
}


// aquesta funcio neteja la entrada del parametre de pagina
// si el la pagina introduida es buida, redirigim a la primera pagina
// si el la pagina introduida no coincideix amb la evaluacio redirigim a la evaluacio
// per exemple, si introduim "123cjedcju1", la evaluacio es 123. 
// si la pagina es 0, redirigim a la 1
// finalment si la apgina es major que el numero maxim de pagines, redirigim al la pagina maxima
function getPagNumber(int $maxPage): int
{
    if (empty($_GET["p"])) {
        redirectClient("?p=1");
    }

    $pag = intval($_GET["p"]);

    if ($pag != $_GET["p"]) {
        redirectClient("?p=$pag");
    }
    if ($pag < 1) {
        redirectClient("?p=1");
    }
    if ($pag > $maxPage) {
        redirectClient("?p=$maxPage");
    }

    return $pag;
}


function printPaginationButton($page, $maxPagination, $maxPage, $minPage)
{


    // fem una comprovacio de si es parell. En cas de ser parell, li sumarem un per que no sigui parell
    // ja que volem que hi hagi un boto de paginacio en mig, per exemple: volem 3 4 5 en comptes de 3 4 5 6
    if (!fmod($maxPagination, 2)) {
        $maxPagination++;
    }

    // configurem un offset per fer servir a l'hora de comprovar si som al maxim o minim de la paginacio
    $offs = ($maxPagination - 1) / 2;

    // iniciem un bucle per mostrar els botons
    for ($p = 1; $p <= min([$maxPage, $maxPagination]); $p++) {

        // uniciem un bucle anidat per fer les comprovacions de si som a prop del maxim o minim de la paginacio
        // el numero de iteracions depen del offset, que aquest depen del tamany de la paginacio. Si tenim 5 botons de pagina
        // el bucle fara 2 iteracions ja que es el que hi ha en un costat
        for ($i = 0; $i < $offs; $i++) {
            // comprovem el costat del principi
            if ($minPage + $i == $page) {
                // si som al costat del pricipi
                // calculem el offset per al principi
                $actualPage = $p - ($i + 1);
                $extreme = true;
                break;
            }
            // comprovem el costat del final
            if ($maxPage - $i == $page) {
                // si som al costat del final
                // calculem l'offset per al final
                $actualPage = ($p - $maxPagination) + $i;
                $extreme = true;
                break;
            }
        }

        // si som a un extrem, no calculem en base al centre de la paginacio
        if (!isset($extreme)) {
            $actualPage = $p - $offs - 1;
        }

        // finalment afegim la pagina als calculs que hem fet
        $actualPage = $page + $actualPage;

        // finalment mostrem el boto amb la pagina calculada anteriorment
        if ($actualPage == $page) {
            echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"?p=$actualPage\">$actualPage</a></li>";
        } else {
            echo "<li class=\"page-item \"><a class=\"page-link\" href=\"?p=$actualPage\">$actualPage</a></li>";
        }
    }
}

function printFirstPage($page, $minPage)
{
    echo "<li class=\"page-item\">";
    if ($page == $minPage) {
        echo "<li class=\"page-item disabled\">";
    } else {
        echo "<li class=\"page-item\">";
    }
    echo "<a class=\"page-link\" href=\"?p=$minPage\" aria-label=\"Next\">";
    echo "      <span aria-hidden=\"true\">&raquo;</span>
                <span class=\"sr-only\">Primera</span>
			</a>
		</li>";
}
function printLastPage($page, $maxPage)
{
    echo "<li class=\"page-item\">";
    if ($page == $maxPage) {
        echo "<li class=\"page-item disabled\">";
    } else {
        echo "<li class=\"page-item\">";
    }
    echo "<a class=\"page-link\" href=\"?p=$maxPage\" aria-label=\"Next\">";
    echo "      <span aria-hidden=\"true\">&raquo;</span>
                <span class=\"sr-only\">Ultima</span>
			</a>
		</li>";
}

function printPagination($page, $minPage, $maxPage, $maxPagination)
{


    echo "<nav><ul class=\"pagination justify-content-center p-5 mt-5\">";
    printFirstPage($page, $minPage);
    printPaginationButton($page, $maxPagination, $maxPage, $minPage);
    printLastPage($page, $maxPage);
    echo "</ul></nav>";
}
