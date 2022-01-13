<?php
class Article
{
    private $id;
    public string $titre;
    public string $article;
    public $id_categorie;
    public $id_utilisateur;
    public $date;

    public function __construct(string $titre, string $article, $id_categorie, $id_utilisateur, $date)
    {
        $this->titre          = $titre;
        $this->article        = $article;
        $this->id_categorie   = $id_categorie;
        $this->id_utilisateur = $id_utilisateur;
        $this->date           = $date;
    }

    public function register()
    {
        function getDatabase()
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

            return $connexion;
        }

        // mise en forme de l'article pour que cela rentre dans la bdd
        $fullarticle = $this->titre." - ".$this->article;

        $selectQ = "SELECT * FROM articles WHERE article='$fullarticle' OR date='$this->date'";
        $insertQ = "INSERT INTO articles(article, id_categorie, id_utilisateur, date) VALUES ('$fullarticle', '$this->id_categorie', '$this->id_utilisateur', '$this->date')";

        $connexion = getDatabase();

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
        $preparation = $connexion->prepare("SELECT id FROM articles WHERE article='$fullarticle' AND date='$this->date'");
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        $this->id = $fetch[0]["id"];
    }

    public function display()
    {
        // récupère la catégorie
        $selectQ = "SELECT * FROM categories WHERE id='$this->id_categorie'";
        $connexion = getDatabase();
        $preparation = $connexion->prepare($selectQ);
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        $categorie = $fetch[0]["nom"];

        // récupère l'auteur
        $selectQ = "SELECT * FROM utilisateurs WHERE id='$this->id_utilisateur'";
        $connexion = getDatabase();
        $preparation = $connexion->prepare($selectQ);
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        $auteur = $fetch[0]["login"];

        echo "
        <article>
            <h1>".$this->titre."</h1>
            <p><b>Catégorie: ".$categorie." - Auteur: ".$auteur." - Publié le: ".$this->date."</b></p>
            <p>".$this->article."</p>
        </article>
        ";
    }

    public function getID()
    {
        return $this->id;
    }
}
?>