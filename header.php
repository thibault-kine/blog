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
        <a href="livre-or.php">BLOG</a>
        <?php
            if(!$_SESSION)
            {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            else
            {
                echo '<a href="commentaire.php">Commentaire</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="index.php">Acceuil</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';
            }
        ?>      
        
</header>
<main>