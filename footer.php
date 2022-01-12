</main>
    <footer>
        <div>
            <h3>navigation</h3>
            <?php
            if(empty($_SESSION))
            {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            // acces admin
            elseif(!empty($_SESSION) && $_SESSION["droit"]["id"]=="1337")
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="creer-article.php">Creer un article</a>';
                echo '<a href="admin.php">Administration</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';

            }
            //acces modo
            elseif(!empty($_SESSION) && $_SESSION["droit"]["id"]=="42")
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
        </div>
        <div id="grplogo">
            <a href="https://github.com/frederick-sonder1?tab=repositories">
                <img src="img/github2.jpg" alt="github logo" id="logo1">
            </a>
            <a href="mailto:frederick.sonder@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" id="logo2">
            </a>
        </div>
        <div id="grplogo">
            <a href="https://github.com/thibault-kine/blog">
                <img src="img/github2.jpg" alt="github logo" id="logo1">
            </a>
            <a href="mailto:frederick.sonder@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" id="logo2">
            </a>
        </div>
    </footer>
</body>
</html>