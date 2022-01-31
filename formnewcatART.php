<?php
    include 'header.php';
    require 'classes/categorie.php';
    $catego = new Categorie();
?>
<form action="" method="post" name="categorie" id="formnewcatart">
    <label for="categorie">Nouvelle categorie</label>
    <input type="text" name="categorie" id="">
    <input type="submit" name="submit" value="submit">
</form>

<?php
    if(isset($_POST['submit']))
    {
        $nom = $_POST['categorie'];
        $catego->register($nom);
        echo "Nouvelle catégorie validée.";
        echo "<br><br>";
        echo "<a href='admin.php'><=RETOUR<=</a>";
    }
    include 'footer.php';
?>