<?php
// Marc Peral 2DAW

// aquesta funcio s'encarrega de connectar amb la base de dades
// si es produeix un error, indiquem a l'usuari que s'ha produit un error i que contacti amb l'administrador
function getMysqlPDO(): PDO
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Pt04_Marc_Peral";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        print "<p>S'ha produit un error a l'hora de connectarse amb la base de dades. Contacta amb l'administrador.</p>";
        die();
    }

    return $conn;
}

// aquesta funcio ens retorna tots els articles, es una funcio de prova
function getArticles(PDO $conn): PDOStatement
{
    $pdo = $conn->prepare('SELECT * from article');
    $pdo->execute();
    return $pdo;
}

// aquesta funcio ens retorna els articles amb paginacio
// segons la pagina en la que ens trobem i el numero maxim d'articles per pagina
// ens retornara uns articles o uns altres (paginacio)
function getArticlePage(PDO $conn, int $page, int $maxArtPerPage): PDOStatement
{
    $minim = ($page * $maxArtPerPage) - $maxArtPerPage;
    $maxim = $maxArtPerPage;
    $dateFormat = "%d/%m/%Y";
    // $pdo = $conn->prepare('SELECT * from article LIMIT :minLimit, :maxLimit');
    $pdo = $conn->prepare("SELECT article, DATE_FORMAT(data, :dateFormat) as data, (SELECT CONCAT(usuari.nom,' ' , usuari.cognoms) FROM usuari WHERE usuari.id = autor) AS Nom FROM article LIMIT :minLimit, :maxLimit");
    $pdo->bindParam(":dateFormat", $dateFormat, PDO::PARAM_STR);
    $pdo->bindParam(":minLimit", $minim, PDO::PARAM_INT);
    $pdo->bindParam(":maxLimit", $maxim, PDO::PARAM_INT);
    $pdo->execute();

    return $pdo;
}

function getArticlePageByUser(PDO $conn, int $page, int $maxArtPerPage, int $userId): PDOStatement
{
    $min = ($page * $maxArtPerPage) - $maxArtPerPage;
    $max = $maxArtPerPage;
    $pdo = $conn->prepare('SELECT * FROM article WHERE article.autor = :autorId LIMIT :minLimit, :maxLimit');
    $pdo->bindParam(":autorId", $userId, PDO::PARAM_INT);
    $pdo->bindParam(":minLimit", $min, PDO::PARAM_INT);
    $pdo->bindParam(":maxLimit", $max, PDO::PARAM_INT);
    $pdo->execute();

    return $pdo;
}

// aquesta funcio ens retorna el numero de articles totals en la base de dades
function getArticleCount(PDO $conn): int
{
    $pdo = $conn->prepare('SELECT count(*) as count FROM article');
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    return $count;
}
function getArticleCountByUser(PDO $conn, int $userId): int
{
    $pdo = $conn->prepare('SELECT count(*) as count FROM article WHERE article.autor = :autorId');
    $pdo->bindParam(":autorId", $userId);
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    return $count;
}
function userExists(PDO $conn, string $email): bool
{
    $pdo = $conn->prepare('SELECT count(*) as count FROM usuari WHERE correu = :correu');
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    if ($count > 0) {
        return true;
    };
    return false;
}

function addUser(PDO $conn, string $name, string $lastname, string $email, string $password): bool
{
    $password = hash("sha256", $password, false);
    $pdo = $conn->prepare("INSERT INTO `usuari` (`nom`, `cognoms`, `correu`, `contrasenya`) VALUES (:nom, :cognoms, :correu, :contrasenya)");
    $pdo->bindParam(":nom", $name);
    $pdo->bindParam(":cognoms", $lastname);
    $pdo->bindParam(":correu", $email);
    $pdo->bindParam(":contrasenya", $password);
    return $pdo->execute();
}

function checkUserPassword(PDO $conn, string $password, string $email): bool
{
    $password = hash("sha256", $password, false);
    $pdo = $conn->prepare("SELECT usuari.contrasenya FROM usuari WHERE usuari.correu LIKE :correu ");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $dbPassword = $pdo->fetch()["contrasenya"];
    if ($password == $dbPassword) {
        return true;
    }
    return false;
}

function getUserInitials(PDO $conn, string $email): string
{
    $pdo = $conn->prepare("SELECT usuari.nom, usuari.cognoms FROM usuari WHERE usuari.correu LIKE :correu");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $row = $pdo->fetch();
    $name = $row["nom"];
    $surname = $row["cognoms"];
    return $name . $surname;
}

function getUserID(PDO $conn, string $email): int
{
    $pdo = $conn->prepare("SELECT usuari.id FROM usuari WHERE usuari.correu LIKE :correu");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $id = $pdo->fetch()["id"];
    return $id;
}
