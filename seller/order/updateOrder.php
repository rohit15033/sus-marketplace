<?php
session_start();

require '../../connect.php';

if (isset($_SESSION['seller_logged_in']) && $_SESSION['seller_logged_in'] === true) {
    $seller_id = $_SESSION['seller_id'];
    $order_number = $_POST['order_number'];
    

    foreach($order_number as $index => $order_number)
    {
        $order_status = $_POST['order_status'][$index];
        $product_id = $_POST['product_id'][$index];

        $updateorderQuery = "UPDATE order_details SET order_status = '$order_status' WHERE order_number = '$order_number' AND product_id = '$product_id'";
        $updateorderResult = mysqli_query($conn, $updateorderQuery);
    }
    header("location: order.php");
    exit();
}