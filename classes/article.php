<?php
class Article
{
    private $id;
    public $titre;
    public $article;
    public $id_auteur;
    public $id_categorie;
    public $date;

    public function __construct($titre, $article, $id_auteur, $id_categorie)
    {
        $this->titre = $titre;
        $this->article = $article;
        $this->id_auteur = $id_auteur;
        $this->id_categorie = $id_categorie;
    }

    public function register()
    {
        $host   = "localhost";
        $dbname = "blog";
        $user   = "root";
        $pass   = "";
        $dsn = "mysql:host=".$host.";dbname=".$dbname.";charset=utf8";

        $pdo = new PDO($dsn, $user, $pass);

        $article = $this->titre." - ".$this->article;
        $id_auteur = $this->id_auteur;
        $id_categorie = $this->id_categorie;

        $stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `article`='$article'");
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo "1er fetch";
        // var_dump($fetch);

        // si un article existe déjà
        if(!empty($fetch))
        {
            echo "Un article identique existe déjà.";
            return;
        }
        // sinon
        else
        {
            $pdo->prepare("INSERT INTO `articles`(`article`, `id_utilisateur`, `id_categorie`, `date`) VALUES ('$article', '$id_auteur', '$id_categorie', CURRENT_TIMESTAMP)")->execute();
            
            $stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `article`='$article'");
            $stmt->execute();
            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // echo "2e fetch";
            // var_dump($fetch);

            $this->id = $fetch[0]["id"];
            $this->date = $fetch[0]["date"];
        }
    }

    public function display($date)
    {
        $host = "localhost";
        $dbname = "blog";
        try 
        {
            $connexion = new PDO(
                "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
                "root",
                ""
            );
        }
        catch(Exception $e)
        {
            die("Erreur: ".$e->getMessage());
        }

        // récupère l'auteur
        $selectQ = "SELECT `login` FROM `utilisateurs` WHERE `id`='$this->id_auteur'";
        $prep = $connexion->prepare($selectQ);
        $prep->execute();
        $fetch = $prep->fetchAll();
        if(!empty($fetch))
        {
            $auteur = $fetch[0]["login"];
        }

        // récupère la catégorie
        $selectQ = "SELECT * FROM `categories` WHERE `id`='$this->id_categorie'";
        $prep = $connexion->prepare($selectQ);
        $prep->execute();
        $fetch = $prep->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($fetch))
        {
            $categorie = $fetch["nom"];
        }

        echo "
        <article>
            <h1>'$this->titre'</h1>
            <p><b>Posté le '$date' par '$auteur' - Catégorie '$categorie'</b></p>
            <p>'$this->article'</p>
        </article>";
    }

    public function getID()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->titre;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function getAuthorID()
    {
        return $this->id_auteur;
    }

    public function getCategoryID()
    {
        return $this->id_categorie;
    }

    public function getDate()
    {
        return $this->date;
    }
}
?>