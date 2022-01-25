<?php
include "header.php";

require "classes/article.php";
?>

<h1>Voir article</h1>

<?php
var_dump($_SESSION["current-article"]);

$tempArticle = new Article(
    $_SESSION["current-article"]["titre"],
    $_SESSION["current-article"]["article"],
    $_SESSION["current-article"]["id_auteur"],
    $_SESSION["current-article"]["id_categorie"]
);
    
var_dump($tempArticle);

$tempArticle->display($_SESSION["current-article"]["date"]);

include "footer.php";
?>