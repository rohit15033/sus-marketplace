<?php 
    if(isset($_POST["signup"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        echo "$email";
        echo "$password";
        echo "$confirm_password";
    }
?>