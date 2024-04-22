<?php 
    session_start();

    if(isset($_POST["login"])) {
        $store_name = $_POST["store_name"];
        $password = $_POST["password"];

        require '../../connect.php';

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
