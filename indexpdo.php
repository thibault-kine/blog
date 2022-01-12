<?php
require("pdo.php");

$myUser = new User(
    "martin13",
    "martinnn",
    "martindu13@gmail.com"
);

$myUser->register();

var_dump($myUser);

$myUser->delete();

var_dump($myUser);
?>