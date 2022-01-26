<?php
    include 'header.php';

    // require "classes/user.php";

    // $admin = new User();
    // $admin->register(
    //     "admin",
    //     "admin",
    //     "admin@adminmail.com",
    //     1337
    // );
?>



<h1>BIENVENUE SUR NOTRE BLOG</h1>
<p>Ici vous pourrez decouvrir plein d'articles ecrit par nos soins</p>

<?php
var_dump($_SESSION);
    require "classes/article.php";
//     public function article()
//         {
//             $selec = "SELECT * FROM `articles` ";
//             $prep = $this -> bdd -> prepare($selec);
//             $exec ->execute();
//             $arti = $exec->fetchAll();
//         }
// var_dump($_SESSION);

?>



<a href="articles.php">Articles</a>
<?php
    include 'footer.php';
?>