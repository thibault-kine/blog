<?php
class Categorie
{
    private $id;
    public $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function register()
    {
        $host = "localhost";
        $dbname = "blog";

        $selectQ = "SELECT * FROM categories WHERE nom='$this->nom'";
        $insertQ = "INSERT INTO categories(nom) VALUES ('$this->nom')";

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
            echo "Une catégorie existe déjà sous ce nom.";
        }
        else
        {
            $preparation = $connexion->prepare($insertQ);
            $preparation->execute();
        }
        // récupérer l'id
        $preparation = $connexion->prepare("SELECT id FROM categories WHERE nom='$this->nom'");
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        $this->id = $fetch[0]["id"];
    }

    public function getID()
    {
        return $this->id;
    }
}
?>