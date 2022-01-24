<?php
    include 'header.php';
require ('classes/user.php');
$user=new User();
    if(empty($_POST))
    {
        echo "veuillez vous connecter!";
    }
    else
    {
    if(!empty($_POST['login']) && !empty($_POST['password']) && isset($_POST['login']) && isset($_POST['password']))
    {   
        $login=$_POST['login'];
        $password=$_POST['password'];
        $user->connect($login,$password);
            if(!empty($_SESSION["utilisateur"]) && isset($_SESSION["utilisateur"]))
            {
                if($_SESSION["utilisateur"]["idd"]==1337 )
                {
                    header('Location:admin.php');
                    exit();
                    
                }
                elseif($_SESSION["utilisateur"]["idd"]==42)
                {
                    header('location: articles.php');
                    exit();    
                }
                else
                {
                    header('Location:index.php');
                    exit();
                }
            }    
    }
}
   
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
    include 'footer.php';
?>