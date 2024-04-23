<?php
session_start();

if (isset($_POST["login"])) {
    $session_user_id = $_SESSION['user_id'];
    $store_name = $_POST["store_name"];
    $password = $_POST["password"];

    require '../../connect.php';

    $junctionQuery = "SELECT * FROM user_seller_junction WHERE user_id = '$session_user_id'";
    $junctionResult = mysqli_query($conn, $junctionQuery);

    // Check if any seller IDs are associated with the user ID
    if (mysqli_num_rows($junctionResult) > 0) {
        while ($junctionRow = mysqli_fetch_assoc($junctionResult)) {
            $seller_id = $junctionRow['seller_id'];

            $fetchQuery = "SELECT * FROM sellers WHERE store_name = '$store_name' AND id = '$seller_id'";
            $fetchResult = mysqli_query($conn, $fetchQuery);

            // Check if a seller with the given store name and ID exists
            if (mysqli_num_rows($fetchResult) == 1) {
                $fetchRow = mysqli_fetch_assoc($fetchResult);
                $hashedPassword = $fetchRow['password'];

                // Verify password
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['seller_logged_in'] = true;
                    $_SESSION['seller_id'] = $seller_id;
                    header("Location: ../homepage/homepage.php");
                } else {
                    $_SESSION['error'] = "Invalid password. Please try again.";
                    header("Location: login.php");
                }
            } else {
                $_SESSION['error'] = "Invalid store_name. Please try again.";
                header("Location: login.php");
            }
        }
    } else {
        // No seller IDs associated with the user ID
        $_SESSION['error'] = "No seller IDs associated with the user.";
        header("Location: login.php");
    }

    mysqli_close($conn);
}
?>
