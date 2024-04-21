<?php 
    session_start();

    if(isset($_POST["login"])) {
        $store_name = $_POST["store_name"];
        $password = $_POST["password"];

        $db_host = "localhost";
        $db_username = "$store_name";
        $db_password = "";
        $db_name = "susmarketplace";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM sellers WHERE store_name = '$store_name'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            $seller_id = $row['id'];
            
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['seller_logged_in'] = true;
                $_SESSION['seller_id'] = $seller_id;

                header("Location: ../homepage/homepage.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid password. Please try again.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid store_name. Please try again.";
            header("Location: login.php");
            exit();
        }

        mysqli_close($conn);
    }
?>
