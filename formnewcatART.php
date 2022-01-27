<?php
    include 'header.php';
    require 'classes/categorie.php';
    $categorie = new Categorie();
?>
<form action="" method="post" name="categorie">
    <label for="categorie">Nouvelle categorie</label>
    <input type="text" name="categorie" id="">
    <input type="submit" value="submit">
</form>