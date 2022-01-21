<?php
    include "header.php";
    unset($_SESSION['utilisateur']);
    // session_destroy();
    header('Location: index.php');
                exit();
?>