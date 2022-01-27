<?php
include "header.php";

require "classes/article.php";
require "classes/commentaire.php";
?>

<h1>Voir article</h1>

<?php
if($_SESSION["utilisateur"]["idd"] == '42' || $_SESSION["utilisateur"]["idd"] == '1337')
{
    echo "
    <form method='post'>
        <input type='submit' name='delete' value='Supprimer cet article'>
    </form>";
}

// var_dump($_SESSION);

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
?>

<form method="post" id="comment-form">
    <label for="commentaire">Commentez :</label>
    <textarea name="commentaire" cols="60" rows="10" placeholder="Lorem ipsum dolor sit amet..."></textarea>
    <input type="submit" name="comm-submit">
</form>

<?php
// suppression de l'article
if($_POST["delete"])
{
    $stmt = $connexion->prepare("DELETE FROM articles WHERE id=:id");
    $stmt->bindValue("id", $_GET["id"], PDO::PARAM_INT);
    $stmt->execute();

    header("location: articles.php");
}

if(!empty($_POST["commentaire"]))
{
    $tempComm = new Commentaire(
        $_POST["commentaire"],
        $_GET["id"],
        $_SESSION["utilisateur"]["id"]
    );

    if($_POST["comm-submit"])
    {
        $tempComm->register();
    }
}

// var_dump($comm);

// afficher les commentaires
$stmt = $connexion->prepare("SELECT * FROM commentaires WHERE id_article=:id ORDER BY id DESC");
$stmt->bindValue("id", $_GET["id"]);
$stmt->execute();
$fetch1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// parcours la liste des commentaires
foreach($fetch1 as $c)
{
    $commentaire = new Commentaire($c["commentaire"], $c["id_article"], $c["id_utilisateur"]);

    // récupère le login de l'auteur
    $stmt = $connexion->prepare("SELECT * FROM utilisateurs WHERE id=:id");
    $stmt->bindValue("id", $c["id_utilisateur"]);
    $stmt->execute();
    $fetchLogin = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $commentaire->display($c["id"], $fetchLogin[0]["login"]);
}

include "footer.php";
?>