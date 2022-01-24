<?php
// session_start();
class User
{
    private $id;
    public $login;
    public $password;
    public $email;
    public $droits;

    public function __construct()
    {
        // $bdd = new PDO('mysql:host=localhost;dbname=blog','root','');
        // $bdd-> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
        // $bdd-> setAttribute(PDO :: ATTR_DEFAULT_FETCH_MODE, PDO :: FETCH_ASSOC);
        // $this-> bdd = $bdd;
        // return $this-> bdd;
    }

    public function register($_login, $_password, $_email, $_droits = 1)
    {
        $this->login    = $_login;
        $this->password = $_password;
        $this->email    = $_email;
        $this->droits   = $_droits;
        if(isset($this->login) && isset($this->email)) 
        {
            $host = "localhost";
            $dbname = "blog";
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

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

    public function getLogin()
    {
        return $this->login;
    }

    public function connect($login, $password)
    {
        
        $host = "localhost";
        $dbname = "blog";

        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        $slctconn = "SELECT * FROM `utilisateurs` WHERE login = ?";
        $stmt=$connexion->prepare($slctconn);
        $stmt->bindValue(1, $login, PDO::PARAM_STR);
        $stmt->execute();
        $reuser=$stmt->fetchAll();

        if (count($reuser) > 0)
        {
            if(password_verify($password,$reuser[0]['password']) || $password==$reuser[0]['password'])
            {
                $_SESSION["utilisateur"]=
                [
                    'id'=>$reuser[0]['id'],
                    'idd'=> $reuser[0]["id_droits"],
                    'login'=>  $reuser[0]["login"],
                    'password'=> $reuser[0]["password"],
                    'email' => $reuser[0]["email"]
                ];
                // var_dump($_SESSION["utilisateur"]);
            }
            else
            {
                echo "mot de passe incorrect!";
            }
        }     
    }

    public function getAllInfo() //sans param, retourne tableau avec infon user
    {
        $host = "localhost";
        $dbname = "blog";

        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        $selec = "SELECT * FROM `utilisateurs` WHERE `login` = :login";
        $login1 = $_POST['login'];
        $id2 = $connexion -> prepare($selec);
        $id2->bindValue(':login', $login1, PDO ::PARAM_STR);
        $id2->execute();
        $user = $id2->fetchAll();
        $login = $user['login'];
        $password = $user['password'];
        $email = $user['email'];


        echo "<table><thead>
        <th>Login</th>
        <th>Password</th>
        <th>Email</th>
    </thead>
    <tbody>
        <tr>
        <td>".$login."</td>
        <td>".$password."</td>
        <td>".$email."</td>
        </tr>
    </tbody></table> ";
    }
    
    public function update($login,$password,$email)
    {
        $this->login = $login;
        $this->password = $password;
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->email    = $email;
        $iduser = $_SESSION['utilisateur']['id'];
        echo $iduser;
        $host = "localhost";
        $dbname = "blog";
        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );
        $up = "UPDATE `utilisateurs` SET `login`='$login',`email`='$email',`password`='$password' WHERE `id`=:iduser";
        // $upda = "SELECT * FROM `utilisateurs` WHERE `id`=$_SESSION[id]";
        $update=$connexion->prepare($up);
        $update->bindValue( ':iduser', $iduser, PDO::PARAM_STR);
        $update->execute();
        $_SESSION['utilisateur']['login']=$login;
        $_SESSION['utilisateur']['email']=$email;
        $_SESSION['utilisateur']['password']=$password;
    }
}
// $user= new User();
// $user->connect('frdk10','mdp10');
// $user->update('frdk10','mdp100','email@email.com');


// $user->connect('admin','admin');
?>