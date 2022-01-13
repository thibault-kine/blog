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
        if(isset($this->login) && isset($this->email))
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
            $preparation->execute();
            $fetch = $preparation->fetchAll();

            if(!empty($fetch))
            {
                echo "Un utilisateur utilise déjà ce login ou cette adresse e-mail.";
            }
            else
            {
                $preparation = $connexion->prepare($insertQ);
                $preparation->execute();
            }
            // récupérer l'id
            $preparation = $connexion->prepare("SELECT id FROM utilisateurs WHERE login='$this->login' AND email='$this->email'");
            $preparation->execute();
            $fetch = $preparation->fetchAll();

            $this->id = $fetch[0]["id"];
        }
        else
        {
            echo "Erreur: Veuillez initialiser l'utilisateur";
            return;
        }
    }
    
    public function delete()
    {
        $host = "localhost";
        $dbname = "blog";

        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        $deleteQ = "DELETE FROM utilisateurs WHERE id='$this->id'";

        $preparation = $connexion->prepare($deleteQ);
        $preparation->execute();

        unset($this->id);
        unset($this->login);
        unset($this->password);
        unset($this->email);
        unset($this->droits);
    }

    public function getID()
    {
        return $this->id;
    }
}
?>