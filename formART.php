<?php
    include 'header.php';
    require 'classes/categorie.php';
?>

<h1>NOUVELLE CATEGORIE</h1>
<form action="" method="post" id="formart">
    <label for="categorie">Changer le nom de la categorie </label>
    <input type="text" name="categorie" value="nouveau nom de categorie">
    <input type="submit" value="submit" name='submit'>
</form>
<?php
    if(isset($_POST['submit']))
    {
        $categ = new Categorie();
        $nom = $_POST['categorie'];
        $categ->updatenomcat($nom);
        echo "Modification validée.";
        echo "<br><br>";
        echo "<a href='admin.php'><=RETOUR<=</a>";
    }
    include 'footer.php';
?>




<!-- FINIR LE FORM, PAS VALABLE ENCORE -->