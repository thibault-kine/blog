<?php
    include 'header.php';
<<<<<<< HEAD
?>

<h1>Profil</h1>

<form action="" method="post">
<label for="login">Login:</label>
            <input type="text" name="login" id="login">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password">
            <label for="password2">Confirmez votre mot de passe:</label>
            <input type="password" name="password2" id="password2">
=======
    include 'pdo.php';
?>

<h1>Profil</h1>
<p>Bonjour <?php echo $_SESSION['utilisateurs']['login'] ?></p>
<p>Ici vous pouvez modifier vore profil</p>

<?php
    // getAllInfo(){
var_dump($_SESSION);
    // }
?>

<form action="" method="post">
<label for="login">Login:</label>
            <input type="text" name="login" id="login" value="<?php echo$_SESSION['utilisateurs']['login'] ?>">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo$_SESSION['utilisateurs']['email'] ?>">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" value="<?php echo$_SESSION['utilisateurs']['password'] ?>">
            <label for="password2">Confirmez votre mot de passe:</label>
            <input type="password" name="password2" id="password2" value="<?php echo$_SESSION['utilisateurs']['password'] ?>">
>>>>>>> main
            <input type="submit" value="submit" name="submit">
</form>



<?php
    include 'footer.php';
?>