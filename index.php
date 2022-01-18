<?php
    include 'header.php';

// public function article()
// {
//     $selec = "SELECT * FROM `articles` ";
//     $prep = $this -> bdd -> prepare($selec);
//     $exec ->execute();
//     $arti = $exec->fetchAll();
// }

var_dump($_SESSION);
?>

<h1>BIENVENUE SUR NOTRE BLOG</h1>
<p>Ici vous pourrez decouvrir plein d'articles ecrit par nos soins</p>

<a href="articles.php">Liste des articles</a>
<?php
    include 'footer.php';
?>