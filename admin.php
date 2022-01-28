<?php
    include 'header.php';
    require 'classes/user.php';
    require 'classes/categorie.php';
?>
    <h2 id="h1admin">UTILISATEURS</h2>
<?php
    $user=new User();
    $user->getUsersInfo();

    if(isset($_GET['suppr']))
    {
        $iduser=$_GET['suppr'];
        $user->delete($iduser);
        header('location:admin.php');
        exit();
    }
?>

<h2 id="h1admin">CATEGORIE D'ARTICLES</h2>

<?php
    $categorie=new Categorie();
    $categorie->getCatInfo();

    if(isset($_GET['supprime']))    
    {
        $idcat=$_GET['supprime'];
        $categorie->delete($idcat);
            header('location:admin.php');
            exit();
    }
?>
<a href="formnewcatART.php" id="lienadm">Nouvelle categorie</a>



<?php
    include 'footer.php';
?>

