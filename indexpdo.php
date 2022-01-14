<?php
require("user.php");
require("article.php");
require("categorie.php");

date_default_timezone_set("Europe/Paris");
$today = time("Y-m-d H:i:s");

$admin = new User(
    "admin",
    "admin",
    "admin@adminmail.com",
    1337
);
$admin->register();
var_dump($admin);

$sports = new Categorie("Sports");
$sports->register();
var_dump($sports);

$article = "Alors qu'on pensait ce sport disparu depuis plus d'un siècle le voici qui fait son retour flamboyant.
Passe-Partout, le porte-parole de l'AFLN (Association Française du Lancer de Nains) nous parle de ce phénomène :
\"V'ai touvours été un amoureux de fe fport. F'est une difipline paffionnante. Après la fin de 
l'émiffion Fort Boyard, ma reconverfion était affurée.\"</p>";

$myArticle = new Article(
    "Le lancer de nains revient à la mode ?",
    $article,
    $admin->getID(),
    $sports->getID(),
    $today
);
$myArticle->register();
var_dump($myArticle);
?>