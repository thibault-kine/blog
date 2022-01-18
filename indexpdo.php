<?php
require("user.php");
require("article.php");
require("categorie.php");

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

$myArticle = new Article(
    "Titre",
    "Hello world",
    $admin->getID(),
    $sports->getID(),
);
$myArticle->register();
var_dump($myArticle);
?>