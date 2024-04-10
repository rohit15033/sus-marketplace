<?php
session_start();
    $_SESSION['user_logged_in'] = false;
    session_unset();
    session_destroy();
    header("Location: ../register/register.html");
    exit();
?>