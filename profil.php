<?php
    include 'header.php';
    include 'classes/user.php';
?>

<h1>Profil</h1>
<?php var_dump($_SESSION) ?>
<p>Bonjour <?php echo $_SESSION["utilisateur"]["login"] ?></p>
<p>Ici vous pouvez modifier vore profil</p>

<?php
    // getAllInfo(){
    // }
?>

<form action="" method="post">
<label for="login">Login:</label>
            <input type="text" name="login" id="login" value="<?php echo$_SESSION['utilisateur']['login'] ?>">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo$_SESSION['utilisateur']['email'] ?>">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" value="<?php echo$_SESSION['utilisateur']['password'] ?>">
            <label for="password2">Confirmez votre mot de passe:</label>
            <input type="password" name="password2" id="password2" value="<?php echo$_SESSION['utilisateur']['password'] ?>">
            <input type="submit" value="submit" name="submit">
</form>



<?php
    include 'footer.php';
?>