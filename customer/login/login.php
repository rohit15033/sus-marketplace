<?php 
    session_start();

    if(isset($_POST["login"]))
    {

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn -> connect_error)
        {
            die("Connection failed: ". $conn -> connect_error);
        }
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['logged_in'] = true;
            header("Location: ../homepage/homepage.html");
            exit();
        }
        else {

            $error = "Invalid email or password. Please try again.";
        }

        mysqli_close($conn);
    }
?>