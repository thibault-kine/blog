<?php
    include 'header.php';
?>
<?php 
    require_once 'pdo.php';

public function article()
{
    $selec = "SELECT * FROM `articles` ";
    $prep = $this -> bdd -> prepare($selec);
    $exec ->execute();
    $arti = $exec->fetchAll();
}
?>




<a href="articles.php">Articles</a>
<?php
    include 'footer.php';
?>