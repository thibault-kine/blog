<?php
// class Article
// {
//     // === ATTRIBUTS === //
//     private $id;
//     public $titre;
//     public $article;
//     public $id_categorie;
//     public $id_utilisateur;
//     public $date;
//     protected $bdd;

//     // === CONSTRUCTEUR === //
//     public function __construct()
//     {
//         $dsn = "mysql:dbname=blog;host=localhost";

//         $this->bdd = new PDO(
//             $dsn,
//             "root",
//             ""
//         );
//         $this->bdd->exec("SET NAMES utf8");

//         $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//         return $this->bdd;
//     }
    
//     // === METHODES === //
//     public function register(string $titre, string $article, $id_categorie, $id_utilisateur, $date)
//     {
//         $this->titre = $titre;
//         $this->article = $article;
//         $this->id_utilisateur = $id_utilisateur;
//         $this->id_categorie = $id_categorie;
//         $this->date = $date;

//         // mise en forme de l'article pour que cela rentre dans la bdd
//         $fullarticle = $titre." - ".$article;

//         // variables de query
//         $selectQ = "SELECT * FROM articles WHERE article='$fullarticle'";
//         $insertQ = "INSERT INTO articles(article, id_categorie, id_utilisateur, date) VALUES ('$fullarticle', '$id_categorie', '$id_utilisateur', '$date')";

//         // insère dans la bdd
//         $preparation = $this->bdd->prepare($insertQ);
//         $preparation->execute();

//         // recherche l'id
//         $preparation = $this->bdd->prepare($selectQ);
//         $preparation->execute();
//         $fetchArticle = $preparation->fetchAll();

//         $this->id = $fetchArticle[0]["id"];
//     }

//     public function display()
//     {
//         // récupère la catégorie
//         $selectQ = "SELECT * FROM categories WHERE id='$this->id_categorie'";
//         $preparation = $this->bdd->prepare($selectQ);
//         $preparation->execute();
//         $fetch = $preparation->fetchAll();

//         $categorie = $fetch[0]["nom"];

//         // récupère l'auteur
//         $selectQ = "SELECT * FROM utilisateurs WHERE id='$this->id_utilisateur'";
//         $preparation = $this->bdd->prepare($selectQ);
//         $preparation->execute();
//         $fetch = $preparation->fetchAll();

//         $auteur = $fetch[0]["login"];

//         echo "
//         <article>
//             <h1>".$this->titre."</h1>
//             <p><b>Catégorie: ".$categorie." - Auteur: ".$auteur." - Publié le: ".$this->date."</b></p>
//             <p>".$this->article."</p>
//         </article>
//         ";
//     }

//     public function getID()
//     {
//         return $this->id;
//     }
// }


class Article
{
    private $id;
    public $titre;
    public $article;
    public $id_auteur;
    public $id_categorie;
    public $date;

    public function __construct($titre, $article, $id_auteur, $id_categorie, $date)
    {
        $this->titre = $titre;
        $this->article = $article;
        $this->id_auteur = $id_auteur;
        $this->id_categorie = $id_categorie;
    }

    public function register()
    {
        $host = "localhost";
        $dbname = "blog";
    
        $fullarticle = $this->titre.$this->article;

        $selectQ = "SELECT * FROM articles WHERE article='$fullarticle'";
        $insertQ = "INSERT INTO articles(article, id_utilisateur, id_categorie, date) VALUES ('$fullarticle', '$this->id_auteur', '$this->id_categorie', '$this->date')";

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

        $preparation = $connexion->prepare($selectQ);
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        if(!empty($fetch))
        {
            echo "Un article existe déjà sous ce nom.";
        }
        else
        {
            $preparation = $connexion->prepare($insertQ);
            $preparation->execute();
        }
        // récupérer l'id
        $preparation = $connexion->prepare("SELECT id FROM articles WHERE article='$fullarticle'");
        $preparation->execute();
        $fetch = $preparation->fetchAll();

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

        echo "
        <article>
            <h1>".$this->titre."</h1>
            <p><b>Posté le ".$this->date." par admin - Catégorie Sports</b></p>
            <p>".$this->article."</p>
        </article>";
    }

    public function getID()
    {
        return $this->id;
    }
}
?>