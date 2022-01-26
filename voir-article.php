<?php
include "header.php";

require "classes/article.php";
?>

<h1>Voir article</h1>

<?php
// var_dump($_SESSION["current-article"]);

$connexion = new PDO(
    "mysql:host=localhost;dbname=blog;charset=utf8",
    "root",
    ""
);

$currArt = array();

foreach($_SESSION["current-article"] as $x)
{
    array_push($currArt, $x);
}

$tempArticle = new Article(
    $currArt[2],
    $currArt[3],
    $currArt[5],
    $currArt[6]
);

// get author login
$stmt = $connexion->prepare("SELECT * FROM utilisateurs WHERE id=:id");
$stmt->bindValue("id", $currArt[4]);
$stmt->execute();
$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
$loginAuteur = $fetch[0]["login"];

// get category login
$stmt = $connexion->prepare("SELECT * FROM categories WHERE id=:id");
$stmt->bindValue("id", $currArt[5]);
$stmt->execute();
$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nomCategorie = $fetch[0]["nom"];

// var_dump($currArt);

$tempArticle->display($currArt[1], $loginAuteur, $nomCategorie);

include "footer.php";
?>