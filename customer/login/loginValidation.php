<?php 
    session_start();

    if(isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $db_host = "localhost";
        $db_username = "$email";
        $db_password = "";
        $db_name = "susmarketplace";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            $user_id = $row['id'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email;

                header("Location: ../homepage/homepage.html");
                exit();
            } else {
                header("Location: login.php");
                $_SESSION['error'] = "Invalid password. Please try again.";
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid email. Please try again.";
            header("Location: login.php");
            exit();
        }

        mysqli_close($conn);
    }
?>
