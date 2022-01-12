<?php
    session_start();
    
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Livre d'or</title>
</head>
<body>
    <header>
        <h1>BLOG</h1>
        <?php
            if(empty($_SESSION))
            {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            // acces admin
            elseif(!empty($_SESSION) && $_SESSION["droit"]["id"]!="1337")
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="creer-article.php">Creer un article</a>';
                echo '<a href="admin.php">Administration</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';

            }
            //acces modo
            elseif(!empty($_SESSION) && $_SESSION["droit"]["id"]!="42")
            {
                echo '<a href="index.php">Acceuil</a>'; 
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="creer-article.php">Creer un article</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';
            }
            // acces user
            else
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<a href="articles.php">Articles</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';

            }
        ?>      
        
</header>
<main>