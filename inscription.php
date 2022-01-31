<?php
    include 'header.php';
    
?>



<h1>Inscrivez-vous</h1>
    <div>
        <form action="inscription.php" method="POST" id="formins">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password">
            <label for="password2">Confirmez votre mot de passe:</label>
            <input type="password" name="password2" id="password2">
            <input type="submit" value="submit" name="submit">
            <a href="connexion.php">Déjà inscrit?</a>
        </form>
    </div>
<?php
    if($_SESSION)
    {
        header("Location:index.php");
        exit();
    }
    elseif(!empty($_POST))
    {  
        require 'classes/user.php';
        $login= $_POST['login'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $passw2=$_POST['password2'];
        
        if(isset($login,$email,$password) && !empty($login) && !empty($email) && !empty($password) && $password == $passw2)
        {
            $user = new User();
            $user->register($login,$password,$email);
            header('location: connexion.php');
            exit();
        }
        elseif(isset($login,$email,$password) && !empty($login) && !empty($email) && !empty($password) && $password != $passw2)
        {
            echo "Votre mot de passe est incorrect";
        }
    }
    else
    {
        echo "un champ est vide";
    }
    include 'footer.php';
?>