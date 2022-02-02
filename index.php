<?php
    include 'header.php';
?>



<h1>BIENVENUE SUR NOTRE BLOG</h1>
<p>Ici vous pourrez decouvrir plein d'articles ecrit par nos soins</p>
<sub>Login admin: machin - MDP: machinnn</sub>

<?php

    require "classes/article.php";
//     public function article()
//         {
//             $selec = "SELECT * FROM `articles` ";
//             $prep = $this -> bdd -> prepare($selec);
//             $exec ->execute();
//             $arti = $exec->fetchAll();
//         }




if($_SESSION)
{
	echo "<br>";
   echo "<a href='articles.php'>Articles</a>";
}
    include 'footer.php';
?>