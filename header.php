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
                echo '<a href="connexion.php" id="lienheader">Connexion</a>';
                echo '<a href="inscription.php" id="lienheader">Inscription</a>';
            }
            // acces admin
             elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="1337")
            {
                echo '<a href="index.php" id="lienheader">Acceuil</a>';
                echo '<a href="articles.php" id="lienheader">Articles</a>';
                echo '<a href="profil.php" id="lienheader">Profil</a>';
                echo '<a href="creer-article.php" id="lienheader">Creer un article</a>';
                echo '<a href="admin.php" id="lienheader">Administration</a>';
                echo '<a href="deconnexion.php" id="lienheader">Deconnexion</a>';

            }
            //acces modo
            elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="42")
            {
                echo '<a href="index.php" id="lienheader">Acceuil</a>'; 
                echo '<a href="articles.php" id="lienheader">Articles</a>';
                echo '<a href="profil.php" id="lienheader">Profil</a>';
                echo '<a href="creer-article.php" id="lienheader">Creer un article</a>';
                echo '<a href="deconnexion.php" id="lienheader">Deconnexion</a>';
            }
            // acces user
            else
            {
                echo '<a href="index.php" id="lienheader">Acceuil</a>';
                echo '<a href="articles.php" id="lienheader">Articles</a>';
                echo '<a href="profil.php" id="lienheader">Profil</a>';
                echo '<a href="deconnexion.php" id="lienheader">Deconnexion</a>';

            }
        ?>      
        
</header>
<main>