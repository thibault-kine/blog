<?php
    include 'header.php';

    //  var_dump($_SESSION);
require ('classes/user.php');

$user=new User();
    if(empty($_POST))
    {
        echo "veuillez vous connecter!";
    }
    else
    {
        // var_dump($_POST);

    if(!empty($_POST['login']) && !empty($_POST['password']) && isset($_POST['login']) && isset($_POST['password']))
    {   
        $login=$_POST['login'];
        $password=$_POST['password'];
        echo $login;
        echo $password;
        echo '<br>';
        
        $user->connect($login,$password);
    
             var_dump($_SESSION["utilisateur"]);
            if(!empty($_SESSION["utilisateur"]) && isset($_SESSION["utilisateur"]))
            {

                if($_SESSION["utilisateur"]["id"]==1337 )
                {
                    header('Location:admin.php');
                    exit();
                    
                }
                elseif($_SESSION["utilisateur"]["id"]==42)
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