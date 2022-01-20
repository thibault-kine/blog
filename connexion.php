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
var_dump($_SESSION);

if($_SESSION)
{
    header("location: profil.php");
}

if(!empty($_POST))
{
    require "classes/user.php";

    $tempUser = new User();

    $tempUser->connect($_POST["login"], $_POST["password"]);

    header("location: profil.php");
}

    // if($_SESSION)
    // {
    //     header("Location:profil.php");
    // }
    // elseif(!empty($_POST))
    // {   
    //     require ('classes/user.php');
        
    //     $login= $_POST['login'];
    //     $password=$_POST['password'];
        
    //     if(isset($login,$password))
    //     {   
    //         $user = new User();
    //         if($reuser[0]["id"]=1337)
    //         {
    //             $user ->connect($login,$password);
    //             // ça ne sert a rien d'utiliser le header ici puisque tu l'utilises déjà dans la méthode connect
    //             // header('Location:profil.php');
    //             exit();
    //         }
    //         elseif($reuser[0]["id"]=42)
    //         {
    //             $user ->connect($login,$password);
    //             // header('location: profil.php');
    //             exit();
    //         }
    //         else
    //         {
    //             $user ->connect($login,$password);
    //             // header('Location:profil.php');
    //             exit();
    //         }
            
            
    //             $_SESSION["id"] = $connect[0]["id"];
    //             $_SESSION["login"] = $connect[0]["login"];
    //             $_SESSION["password"] = $connect[0]["password"];
    //             $_SESSION["email"] = $connect[0]["email"];
    //             $_SESSION["droits"] = $connect[0]["id_droits"];
            

    //         header("location: profil.php");
    //     }

    //     else
    //     {
    //         echo "votre mot de passe est incorrect.";
    //     }
    // }
?>

<?php
    include 'footer.php';
?>