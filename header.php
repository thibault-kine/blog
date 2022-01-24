<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="blog.css">
    <title>BLOG</title>
</head>
<body>
    <header>
        <h1>BLOG</h1>
        <?php
        session_start();

            if(empty($_SESSION))

            {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            // acces admin
             elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="1337")
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<label for="">Catégories d\'article</label>
                <select name="categorie">
                   <option valeur="cat1">Catégorie 1</option>
                   <option valeur="cat2">Catégorie 2</option>
                   <option valeur="cat3">Catégorie 3</option>
                   <option valeur="cat4">Catégorie 3</option>
                </select>';
                echo '<a href="articles.php">Articles</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="creer-article.php">Creer un article</a>';
                echo '<a href="admin.php">Administration</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';

            }
            //acces modo
            elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="42")
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<label for="">Catégories d\'article</label>
                <select name="categorie">
                   <option valeur="cat1">Catégorie 1</option>
                   <option valeur="cat2">Catégorie 2</option>
                   <option valeur="cat3">Catégorie 3</option>
                   <option valeur="cat4">Catégorie 3</option>
                </select>'; 
                echo '<a href="articles.php">Articles</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="creer-article.php">Creer un article</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';
            }
            // acces user
            else
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<label for="">Catégories d\'article</label>
                <select name="categorie">
                   <option valeur="cat1">Catégorie 1</option>
                   <option valeur="cat2">Catégorie 2</option>
                   <option valeur="cat3">Catégorie 3</option>
                   <option valeur="cat4">Catégorie 3</option>
                </select>';
                echo '<a href="articles.php">Articles</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';

            }
        ?>      
        
</header>
<main>