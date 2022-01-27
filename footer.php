</main>
    <footer>
        <div  id="lienperso">
            <?php
            if(empty($_SESSION))
            {
                echo '<a href="connexion.php" id="lienfooter">Connexion</a>';
                echo '<a href="inscription.php" id="lienfooter">Inscription</a>';
            }
            // acces admin
             elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="1337")
            {
                echo '<a href="index.php" id="lienfooter">Acceuil</a>';
                echo '<a href="articles.php" id="lienfooter">Articles</a>';
                echo '<a href="profil.php" id="lienfooter">Profil</a>';
                echo '<a href="creer-article.php" id="lienfooter">Creer un article</a>';
                echo '<a href="admin.php" id="lienfooter">Administration</a>';
                echo '<a href="deconnexion.php" id="lienfooter">Deconnexion</a>';

            }
            //acces modo
            elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="42")
            {
                echo '<a href="index.php" id="lienfooter">Acceuil</a>'; 
                echo '<a href="articles.php" id="lienfooter">Articles</a>';
                echo '<a href="profil.php" id="lienfooter">Profil</a>';
                echo '<a href="creer-article.php" id="lienfooter">Creer un article</a>';
                echo '<a href="deconnexion.php">Deconnexion</a>';
            }
            // acces user
            else
            {
                echo '<a href="index.php" id="lienfooter">Acceuil</a>';
                echo '<a href="articles.php" id="lienfooter">Articles</a>';
                echo '<a href="profil.php" id="lienfooter">Profil</a>';
                echo '<a href="deconnexion.php" id="lienfooter">Deconnexion</a>';

            }
        ?>      
        </div>
        <div id="grplogo">
            <h5>Fred</h5>
            <a href="https://github.com/frederick-sonder1/blog">
                <img src="img/github2.png" alt="github logo" id="logo1">
            </a>
            <a href="mailto:frederick.sonder@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" id="logo2">
            </a>
            <h5> Thibault</h5>
            <a href="https://github.com/thibault-kine/blog">
                <img src="img/github2.png" alt="github logo" id="logo1">
            </a>
            <a href="mailto:thibault-kine@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" id="logo2">
            </a>
        </div>
    </footer>
</body>
</html>