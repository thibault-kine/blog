<?php
class Commentaire
{
    private $id;
    public $commentaire;
    public $id_article;
    public $id_utilisateur;
    public $date;

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

        $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE commentaire=:comm");
        $stmt->bindValue("comm", $this->commentaire);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo "1er fetch";
        // var_dump($fetch);

        // si un article existe déjà
        if(!empty($fetch))
        {
            echo "Un commentaire identique existe déjà.";
            return;
        }
        // sinon
        else
        {
            $insert = $pdo->prepare("INSERT INTO `commentaires`(`commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES (:comm, :art, :user, CURRENT_TIMESTAMP)");
            $insert->bindValue("comm", $this->commentaire);
            $insert->bindValue("art", $this->id_article);
            $insert->bindValue("user", $this->id_utilisateur);
            $insert->execute();
            
            $stmt = $pdo->prepare("SELECT * FROM `commentaires` WHERE `commentaire`=:comm");
            $stmt->bindValue("comm", $this->commentaire);
            $stmt->execute();
            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // echo "2e fetch";
            // var_dump($fetch);

            $this->id = (int)$fetch[0]["id"];
            $this->date = $fetch[0]["date"];
        }
    }

    public function display($id, $username)
    {
        $host = "localhost";
        $dbname = "blog";
        
        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        // récupère la date
        $stmt = $connexion->prepare("SELECT * FROM commentaires WHERE id=:id");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->date = $fetch[0]["date"];

        echo "
        <div class='comm'>
            <p id='info'><b>Posté le ".$this->date." par ".$username."</b></p>
            <p>".$this->commentaire."</p>
        </article>";
    }
}
?>