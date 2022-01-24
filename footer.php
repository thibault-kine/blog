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
             elseif(!empty($_SESSION) && $_SESSION["utilisateur"]["idd"]=="1337")
            {
                echo '<a href="index.php">Acceuil</a>';
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
                echo '<a href="articles.php">Articles</a>';
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
        </div id="lienperso">
        <div id="grplogo">
            <h6>fred</h6>
            <a href="https://github.com/frederick-sonder1/blog">
                <img src="img/github2.png" alt="github logo" id="logo1">
            </a>
            <a href="mailto:frederick.sonder@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" id="logo2">
            </a>
        </div>
        <div id="grplogo">
            <h6>thibault</h6>
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