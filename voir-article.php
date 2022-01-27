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

if(isset($_SESSION["current-article"]))
{
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
}
// si la page est accedée depuis la liste des articles
else
{
    $stmt = $connexion->prepare("SELECT * FROM articles WHERE id=:id");
    $stmt->bindValue("id", $_GET["id"]);
    $stmt->execute();
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $split = explode(" - ", $fetch[0]["article"]);

    $titre = $split[0];
    $article = $split[1];
    $id_auteur = $fetch[0]["id_utilisateur"];
    $id_cat = $fetch[0]["id_categorie"];

    // utilisateur
    $stmt = $connexion->prepare("SELECT * FROM utilisateurs WHERE id=:id");
    $stmt->bindValue("id", $id_auteur);
    $stmt->execute();
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $login = $fetch[0]["login"];

    // categorie
    $stmt = $connexion->prepare("SELECT * FROM categories WHERE id=:id");
    $stmt->bindValue("id", $id_auteur);
    $stmt->execute();
    $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categorie = $fetch[0]["nom"];


    $currArt = new Article(
        $titre,
        $article,
        $id_auteur,
        $id_cat
    );

    $currArt->display($_GET["id"], $login, $categorie);
}


include "footer.php";
?>