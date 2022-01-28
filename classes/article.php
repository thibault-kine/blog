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
        $this->id_auteur = (int)$id_auteur;         //     cast
        $this->id_categorie = (int)$id_categorie;   // mixed to int
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
            $insert = $pdo->prepare("INSERT INTO `articles`(`article`, `id_utilisateur`, `id_categorie`, `date`) VALUES (:article, :auteur, :cat, CURRENT_TIMESTAMP)");
            $insert->bindValue("article", $article);
            $insert->bindValue("auteur", $id_auteur);
            $insert->bindValue("cat", $id_categorie);
            $insert->execute();
            
            $stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `article`=:article");
            $stmt->bindValue("article", $article);
            $stmt->execute();
            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // echo "2e fetch";
            // var_dump($fetch);

            $this->id = (int)$fetch[0]["id"];
            $this->date = $fetch[0]["date"];
        }
    }

    public function display($id, $username, $category)
    {
        $host = "localhost";
        $dbname = "blog";
        
        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        // récupère la date
        $stmt = $connexion->prepare("SELECT * FROM articles WHERE id=:id");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->date = $fetch[0]["date"];

        echo "
        <article>
            <h1>".$this->titre."</h1>
            <p id='info'><b>Posté le ".$this->date." par ".$username." - Catégorie ".$category."</b></p>
            <p>".$this->article."</p>
        </article>";
    }

    public function displayInline($id, $username, $category)
    {
        $host = "localhost";
        $dbname = "blog";
        
        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        // récupère la date
        $stmt = $connexion->prepare("SELECT * FROM articles WHERE id=:id");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->date = $fetch[0]["date"];

        echo "
        <a href='voir-article.php?id=".$id."' class='inline-article-link' name='link'>
        <div class='inline-article'>
            <h2>".$this->titre."</h2>
            <h3>Par ".$username." | Catégorie ".$category."</h3>
        </div></a>";
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

    // Setters

    public function setTitle($t)
    {
        $this->titre = $t;
    }

    public function setArticle($a)
    {
        $this->article = $a;
    }

    public function setAuthorID($authID)
    {
        $this->id_auteur = $authID;
    }

    public function setCategoryID($catID)
    {
        $this->id_categorie = $catID;
    }
}
?>