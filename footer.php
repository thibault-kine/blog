</main>
    <footer>
        <div>
            <h3>navigation</h3>
            <?php
                $host = "localhost";
                $user = "root";
                $bdd = "blog";
                $pass = "";
                $conn = new PDO("mysql:host=".$host.";dbname=".$bdd.";charset=utf8",
                "root",
                ""
                );

                try
                {
                    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo 'connexion établie';
                }
                catch(PDOException $e)
                {
                    echo 'Erreur: '.$e->getMessage();
                }

                $slct = "SELECT * FROM `utilisateurs` INNER JOIN `droits`";
                $prepaslct = $conn -> prepare($slct);
                $result = $prepaslct -> execute();
                // var_dump($result);
                // $result -> FETCH_ASSOC();


            if(empty($_SESSION))
            {
                echo '<a href="connexion.php">Connexion</a>';
                echo '<a href="inscription.php">Inscription</a>';
            }
            // acces admin
            elseif(!empty($_SESSION) && $_SESSION["droits"]["id"]=="1337")
            {
                echo '<a href="index.php">Acceuil</a>';
                echo '<a href="articles.php">Articles</a>';
                echo '<a href="profil.php">Profil</a>';
                echo '<a href="creer-article.php">Creer un article</a>';
                echo '<a href="admin.php">Administration</a>';
                echo '<a href="deconnexion.php">Déconnexion</a>';

            }
            //acces modo
            elseif(!empty($_SESSION) && $_SESSION["droits"]["id"]=="42")
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
                <img src="img/github.png" alt="github logo" class="logo1">
            </a>
            <a href="mailto:frederick.sonder@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" class="logo2">
            </a>
        </div>
        <div id="grplogo">
            <h6>thibault</h6>
            <a href="https://github.com/thibault-kine/blog">
                <img src="img/github.png" alt="github logo" class="logo1">
            </a>
            <a href="mailto:thibault-kine@laplateforme.io">                    
                <img src="img/mail2.png" alt="image mail" class="logo2">
            </a>
        </div>
    </footer>
</body>
</html>