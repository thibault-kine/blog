<?php
    include "header.php";
    unset($_SESSION);
    session_destroy();
    header('Location: index.php');
                exit();
?>