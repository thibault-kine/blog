<?php
//session_start();
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
        $this->droits   = (int)$_droits;
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
    
    public function delete($id)
    {
        $host = "localhost";
        $dbname = "blog";

        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        $deleteQ = "DELETE  FROM utilisateurs WHERE id=:id";

        $preparation = $connexion->prepare($deleteQ);
        $preparation->bindValue(':id', $id, PDO::PARAM_INT);
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

        $selec = "SELECT * FROM `utilisateurs`";
        $id2 = $connexion -> prepare($selec);
        $id2->execute();
        $users = $id2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
            <table>
                <thead> 
                    <th>id</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>id_droits</th>
                </thead>
        <?php foreach($users as $key=>$util):?>
        
               <tbody>
                    <tr>
                    <td><?=$util['id']?></td>
                    <td><?=$util['login']?></td>
                    <td>Mot de passe non modifiable</td>
                    <td><?=$util['email']?></td>
                    <td><?=$util['id_droits']?></td>
                    <td><a href="?suppr=<?= $util['id'] ?>">Supprimer</a></td>
                    <td><a href="formIDD.php?modif=<?= $util['id'] ?>">Modifier</a></td>
                    </tr>
                </tbody>
        <?php endforeach ?>
            </table>
<?php  
    }
    
    public function update($login,$password,$email)
    {
        $this->login = $login;
        $this->password = $password;
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->email = $email;
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
        $update=$connexion->prepare($up);
        $update->bindValue( ':iduser', $iduser, PDO::PARAM_STR);
        $update->execute();
        $_SESSION['utilisateur']['login']=$login;
        $_SESSION['utilisateur']['email']=$email;
        $_SESSION['utilisateur']['password']=$password;
    }

    public function updateidd($droits)
    {
        var_dump($droits);
        // $this->droits = $droits;
        $host = "localhost";
        $dbname = "blog";
        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );
        $idget= $_GET['modif'];
        $upda= "UPDATE utilisateurs SET id_droits = :id_droits WHERE id =:idget";
        $updateadmin=$connexion->prepare($upda);
        $updateadmin->bindvalue(":id_droits", $droits,PDO::PARAM_INT);
        $updateadmin->bindvalue(":idget", $idget,PDO::PARAM_INT);
        $updateadmin->execute();
    }
}
// var_dump($droits);
// $user=new User();
// $user->connect('admin','admin');
// $user->updateidd($droits);
?>