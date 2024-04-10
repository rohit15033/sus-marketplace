<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    $user_id = $_SESSION['user_id'];
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "susmarketplace";
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['add_to_cart'])) {

        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        echo "<a href='viewCart.php'> View Cart </a>";

        $checkcartQuery = "select * from cart where user_id = '$user_id' AND product_id = '$product_id'";
        $checkcartResult = mysqli_query($conn, $checkcartQuery);

        if (mysqli_num_rows($checkcartResult) > 0) {
            $updatecartQuery = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $updatecartResult = mysqli_query($conn, $updatecartQuery);
        } else {
            $addtocartQuery = "INSERT INTO CART (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
            $addtocartResult = mysqli_query($conn, $addtocartQuery);
        }
    } else if (isset($_POST['update_cart'])) {
        $new_quantity = $_POST['new_quantity'];
        foreach ($new_quantity as $product_id => $quantity) {
            if ($quantity > 0) {
                $updatecartQuery = "UPDATE cart SET quantity = $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $updatecartResult = mysqli_query($conn, $updatecartQuery);
            } else {
                $deletefromcartQuery = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $deletefromcartResult = mysqli_query($conn, $deletefromcartQuery);
            }
        }
        header("location: viewCart.php");
    } else if (isset($_POST['order'])) {
        foreach ($new_quantity as $product_id => $quantity) {
            if ($quantity > 0) {
                $updatecartQuery = "UPDATE cart SET quantity = $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $updatecartResult = mysqli_query($conn, $updatecartQuery);
            } else {
                $deletefromcartQuery = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                $deletefromcartResult = mysqli_query($conn, $deletefromcartQuery);
            }
        }
        header("location: ../order/order.php");
    }
}
