<?php
class User
{
    private $id;
    public $login;
    public $password;
    public $email;
    public $droits;

    public function __construct($_login, $_password, $_email, $_droits = 1)
    {
        $this->login    = $_login;
        $this->password = $_password;
        $this->email    = $_email;
        $this->droits   = $_droits;
    }

    public function register()
    {
        $host = "localhost";
        $dbname = "blog";

        $selectQ = "SELECT * FROM utilisateurs WHERE login='$this->login' OR email='$this->email'";
        $insertQ = "INSERT INTO utilisateurs(login, password, email, id_droits) VALUES ('$this->login', '$this->password', '$this->email', '$this->droits')";

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
        $fetch = $preparation->fetchAll();

        if(!empty($fetch))
        {
            echo "Un utilisateur utilise déjà ce login ou cette adresse e-mail.";
            return;
        }
        else
        {
            $preparation = $connexion->prepare($insertQ);
            $fetch = $preparation->fetchAll();

            $this->id = $fetch["id"];
        }
    }
}
?>