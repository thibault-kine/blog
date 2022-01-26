<?php
    include 'header.php';
    require 'classes/user.php';

    $user=new User();
    $user->getAllInfo();

    if(isset($_GET['suppr']))
    {
        $iduser=$_GET['suppr'];
        $user->delete($iduser);
        header('location:admin.php');
        exit();
    }
?>







<?php
    include 'footer.php';
?>

