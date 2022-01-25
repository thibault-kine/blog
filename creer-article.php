<?php
include "header.php";

require "classes/user.php";
require "classes/article.php";
require "classes/categorie.php";
?>

<h1>Créer article</h1>

<form method="post" id="article-form">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" required="required">
    <label for="categorie">Catégorie :</label>
    <select name="categorie" required="required">
        <!-- Valeur par défault -->
        <option value="default">Choisissez une catégorie</option>
        <?php
        $connexion = new PDO(
            "mysql:host=localhost;dbname=blog;charset=utf8",
            "root",
            ""
        );
        $selectQuery = "SELECT * FROM categories";

        $stmt = $connexion->prepare($selectQuery);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Fait le tour des catégories existantes et les ajoute dans le select
        foreach($fetch as $categorie)
        {
            echo "<option value='".$categorie["id"]."'>".$categorie["nom"]."</option>";
        }
        ?>
    </select>

    <label for="article">Corps de l'article</label>
    <textarea name="article" cols="100" rows="20" placeholder="Lorem, ipsum dolor sit amet..." required="required"></textarea>

    <input type="submit" name="submit">
</form>

<?php


// Si le formulaire n'est pas vide
if(!empty($_POST["titre"]) && !empty($_POST["article"]))
{
    // Si la catégorie sélectionnée n'est pas celle par défault, et que l'utilisateur possède les droits
    if($_POST["catégorie"] != "default" && ($_SESSION["utilisateur"]["idd"] == "1337" || $_SESSION["utilisateur"]["idd"] = "42"))
    {
        $article = new Article(
            $_POST["titre"], // le titre du formulaire
            $_POST["article"], // le corps de l'article (balise <textarea>)
            $_SESSION["utilisateur"]["id"], // l'id de l'user qui a écrit l'article
            $_POST["categorie"] // l'id de la categorie
        );
        
        if($_POST["submit"])
        {
            $article->register(); // renseigne l'article dans la bdd

            $_SESSION["current-article"] = $article;

            header("location: voir-article.php");
        }
    }
}

var_dump($_SESSION);

include "footer.php";
?>