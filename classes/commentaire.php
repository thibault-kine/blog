<?php
class Commentaire
{
    private $id;
    public $commentaire;
    public $id_article;
    public $id_utilisateur;

    public function __construct($commentaire, $id_article, $id_utilisateur)
    {
        $this->commentaire = $commentaire;
        $this->id_article = $id_article;
        $this->id_utilisateur = $id_utilisateur;
    }

    public function register()
    {
        $host   = "localhost";
        $dbname = "blog";
        $user   = "root";
        $pass   = "";
        $dsn = "mysql:host=".$host.";dbname=".$dbname.";charset=utf8";

        $pdo = new PDO($dsn, $user, $pass);

        $commentaire = $this->commentaire;
        $id_article = $this->id_article;
        $id_utilisateur = $this->id_utilisateur;

        $stmt = $pdo->prepare("SELECT * FROM `commentaire` WHERE `commentaire`='.$commentaire.' AND `id_utilisateur`='.$id_utilisateur.'");
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // si un commentaire existe déjà
        if(!empty($fetch))
        {
            echo "Un commentaire identique existe déjà.";
            return;
        }
        // sinon
        else
        {
            $pdo->prepare("INSERT INTO `commentaires`(`commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES ('.$commentaire.', '.$id_article.', '.$id_utilisateur.', CURRENT_TIMESTAMP)")->execute();
        }

        $stmt = $pdo->prepare("SELECT `id` FROM `commentaire` WHERE `commentaire`='.$commentaire.' AND `id_utilisateur`='.$id_utilisateur.'");
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
        $selectQ = "SELECT `login` FROM `utilisateurs` WHERE `id`='$this->id_utilisateur'";
        $prep = $connexion->prepare($selectQ);
        $prep->execute();
        $fetch = $prep->fetchAll();
        if(!empty($fetch))
        {
            $auteur = $fetch[0]["login"];
        }

        echo "
        <div class='commentaire'>
            <h2>".$auteur." a dit:</h2>
            <p>".$this->commentaire."</p>
        </div>
        ";
    }
}
?>