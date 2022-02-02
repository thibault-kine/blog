<?php
    include 'header.php';
    require 'classes/user.php';
?>

<h1>Profil</h1>
<p id="pageprofil">Bonjour <?php echo $_SESSION["utilisateur"]["login"] ?></p>
<p>Ici vous pouvez modifier vore profil</p>

<?php
    if(!$_SESSION)
    {
        header("Location:index.php");
    }

?>

<form action="" method="post" id="formprof">
<label for="login">Login:</label>
            <input type="text" name="login" id="login" value="<?php echo $_SESSION['utilisateur']['login'] ?>">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $_SESSION['utilisateur']['email'] ?>">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" placeholder="Modifiez votre mots de passe">
            <label for="password2">Confirmez votre mot de passe:</label>
            <input type="password" name="password2" id="password2" placeholder="Répétez votre mot de passe">
            <input type="submit" value="submit" name="submit">
</form>

<?php
    if(!empty($_POST))
    { 
        $login= $_POST['login'];
        $email= $_POST['email'];
        $password=$_POST['password'];
        $id=$_SESSION['utilisateur']['id'];
        $user=new User;
        $user->update($login,$password,$email);
        
        header('location:profil.php');
        exit();
    }
    include 'footer.php';
?>