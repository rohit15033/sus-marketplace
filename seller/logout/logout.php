<?php
session_start();
    $_SESSION['seller_logged_in'] = false;
    session_unset();
    header("Location: ../register/register.php");
    exit();
?>