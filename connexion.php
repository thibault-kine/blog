<?php
    include 'header.php';
   
?>

<h1>Connectez-vous</h1>
    <form action="" method="post">
        <label for="login">Login</label>
        <input type="text" name="login" id="login">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="submit">
    </form>
<?php
    require("pdo.php");
    if(!empty($_POST))
    {   
        if(isset($login,$password) && !empty($login) && !empty($password))
        {
            
            $user ->connect();
            // $login= ($_POST['login']);
            // $password=($_POST['password']);
            // $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','');
            // $slct = "SELECT * FROM `utilisateurs` WHERE `login`='$login'";
            // $prep = $bdd->prepare($slct);
            // $prep ->execute();
            // $utilisateur = $prep -> fetchAll();
            if($password==$utilisateur["password"])
            {
                if($utilisateur["login"]=="admin")
                {
                    $_SESSION['utilisateur'] = $utilisateur;
                    header('Location: admin.php');
                    exit();
                }
                else
                {
                    $_SESSION['utilisateur'] = $utilisateur;
                    header('Location: profil.php');
                    exit();
                }
            }
            else
            {
                 echo "votre mot de passe est incorrect.";
            }
        }
    }
    else
    var_dump($_SESSION);
?>

<?php
    include 'footer.php';
?>