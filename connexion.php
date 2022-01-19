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
    if($_SESSION)
    {
        header("Location:profil.php");
    }
    elseif(!empty($_POST))
    {   
        require ('classes/user.php');
        
        $login= $_POST['login'];
        $password=$_POST['password'];
        
        if(isset($login,$password))
        {   
            $user = new User();
            if($reuser["id"]=1337)
            {
                $user ->connect($login,$password);
                header('Location:profil.php');
                exit();
            }
            elseif($reuser["id"]=42)
            {
                $user ->connect($login,$password);
                header('location: profil.php');
                exit();
            }
            else
            {
                $user ->connect($login,$password);
                header('Location:profil.php');
                exit();
            }
            var_dump($reuser);
        }

        else
        {
            echo "votre mot de passe est incorrect.";
        }
    }
?>

<?php
    include 'footer.php';
?>