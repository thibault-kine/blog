<?php
    include 'header.php';
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
            <input type="submit" value="submit" name="submit">
</form>



<?php
    include 'footer.php';
?>