<?php
include "header.php";

require "classes/article.php";
?>

<h1>Voir article</h1>

<?php
var_dump($_SESSION["current-article"]);
if(!empty($_SESSION["current-article"]))
{
    $articleID = $_SESSION["current-article"]["id"];
    $selectQuery = "SELECT * FROM articles WHERE id=:id";

    $stmt = $connexion->prepare($selectQuery);
    $stmt->bindValue("id", $articleID);
    $stmt->execute();
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $currentArticle = new Article(
        $_SESSION["current-article"]["titre"],
        $_SESSION["current-article"]["article"],
        $_SESSION["current-article"]["auteur"],
        $_SESSION["current-article"]["categorie"]
    );
    $currentArticle->display();
}
?>

<?php
include "footer.php";
?>