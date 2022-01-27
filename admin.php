<?php
    include 'header.php';
    require 'classes/user.php';
    require 'classes/categorie.php';
?>
    <h1>UTILISATEURS</h1>
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

<h1>CATÉGORIE D'ARTICLES</h1>

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




<?php
    include 'footer.php';
?>

