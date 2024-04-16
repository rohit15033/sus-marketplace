<?php 
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)
{
    header("Location: homepage.html");
}
else
    header("Location: ../login/login.php");
?>