<?php
    include 'header.php';
    require 'classes/categorie.php';
    $categ = new Categorie();
    var_dump($_GET['modif']);

?>
<form action="" method="post">
    <label for="categorie">Changer le nom de la categorie </label>
    <input type="text" name="categorie">
    <input type="submit" value="submit">
</form>



<?php
    if(isset($_POST['submit']))
    {
        $nom = $_POST['categorie'];
        $categ->update($nom);
        echo "Modification validée.";
        echo "<br><br>";
        echo "<a href='admin.php'><=RETOUR<=</a>";
    }
    include 'footer.php';
?>




<!-- FINIR LE FORM, PAS VALABLE ENCORE -->