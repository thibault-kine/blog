<?php
class Article
{
    private $id;
    public $titre;
    public $article;
    public $id_auteur;
    public $id_categorie;

    public function __construct($titre, $article, $id_auteur, $id_categorie)
    {
        $this->titre = $titre;
        $this->article = $article;
        $this->id_auteur = $id_auteur;
        $this->id_categorie = $id_categorie;
    }

    public function register()
    {
        date_default_timezone_set("Europe/Paris");
        $today = date("Y-m-d");

        $this->date = $today;

        $host   = "localhost";
        $dbname = "blog";
        $user   = "root";
        $pass   = "";
        $dsn = "mysql:host=".$host.";dbname=".$dbname.";charset=utf8";

        $pdo = new PDO($dsn, $user, $pass);

        $article = $this->titre." - ".$this->article;
        $id_auteur = $this->id_auteur;
        $id_categorie = $this->id_categorie;

        $stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `article`='.$article.'");
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // si un article existe déjà
        if(!empty($fetch))
        {
            echo "Un article identique existe déjà.";
            return;
        }
        // sinon
        else
        {
            $pdo->prepare("INSERT INTO `articles`(`article`, `id_utilisateur`, `id_categorie`, `date`) VALUES ('.$article.', '.$id_auteur.', '.$id_categorie.', CURRENT_TIMESTAMP)")->execute();
        }

        $stmt = $pdo->prepare("SELECT `id` FROM `articles` WHERE `article`='.$article.'");
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->id = $fetch[0]["id"];
    }

    public function display()
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
        $selectQ = "SELECT `nom` FROM `categories` WHERE `id`='$this->id_categorie'";
        $prep = $connexion->prepare($selectQ);
        $prep->execute();
        $fetch = $prep->fetchAll();
        if(!empty($fetch))
        {
            $categorie = $fetch[0]["nom"];
        }

        echo "
        <article>
            <h1>".$this->titre."</h1>
            <p><b>Posté le ".$this->date." par ".$auteur." - Catégorie ".$categorie."</b></p>
            <p>".$this->article."</p>
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
}
?>