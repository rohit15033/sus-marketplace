<?php 
    session_start();

    if(isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $db_host = "localhost";
        $db_username = "$email";
        $db_password = "$password";
        $db_name = "susmarketplace";

        try {
            $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $hashedPassword = $user['password'];

                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['logged_in'] = true;
                    header("Location: ../homepage/homepage.html");
                    exit();
                } else {
                    $_SESSION['error'] = "Invalid username or password. Please try again.";
                    header("Location: login.html");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Invalid username or password. Please try again.";
                header("Location: login.html");
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Invalid username or password. Please try again.";
            header("Location: login.html");
            exit();
        }

        mysqli_close($conn);
    }
?>
