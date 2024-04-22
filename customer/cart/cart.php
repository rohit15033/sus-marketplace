<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {

    require '../../connect.php';

    $user_id = $_SESSION['user_id'];


    if (isset($_POST['add_to_cart'])) {

        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $currentDate = date("Y-m-d");

        echo "<a href='viewCart.php'> View Cart </a>";

        $checkcartQuery = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $checkcartResult = mysqli_query($conn, $checkcartQuery);

        if (mysqli_num_rows($checkcartResult) > 0) {
            $updatecartQuery = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $updatecartResult = mysqli_query($conn, $updatecartQuery);
        } else {
            
            //if cart table is empty make a new order else just use the current order_number then
            //when user confirms order flush the cart and push the cart data into order details which uses the order details from cart 

            $checkorderQuery = "SELECT * FROM cart WHERE user_id = '$user_id'";
            $checkorderResult = mysqli_query($conn, $checkorderQuery);

            if (mysqli_num_rows($checkorderResult) == 0) {
                $order_number = rand(100000, 999999);
                $makeorderQuery = "INSERT INTO orders (`date`, `number`) VALUES ('$currentDate', '$order_number')";
                $makeorderResult = mysqli_query($conn, $makeorderQuery);

                $addtocartQuery = "INSERT INTO cart (user_id, product_id, quantity, order_number) VALUES ('$user_id', '$product_id', '$quantity', '$order_number')";
                $addtocartResult = mysqli_query($conn, $addtocartQuery);
            } else {
                
                $ordernumberRow = mysqli_fetch_assoc($checkorderResult);
                $order_number = $ordernumberRow['order_number'];

                $addtocartQuery = "INSERT INTO cart (user_id, product_id, quantity, order_number) VALUES ('$user_id', '$product_id', '$quantity', '$order_number')";
                $addtocartResult = mysqli_query($conn, $addtocartQuery);
            }
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
            $viewcartQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
            $viewcartResult = mysqli_query($conn, $viewcartQuery);
            $totalPrice = 0;

            while ($cartrow = mysqli_fetch_assoc($viewcartResult)) {
                $cart_quantity = $cartrow['quantity'];
                $product_id = $cartrow['product_id'];

                $retrieveproductdataQuery = "SELECT * FROM product_seller_view where product_id = '$product_id'";
                $retrieveproductdataResult = mysqli_query($conn, $retrieveproductdataQuery);
                $productrow = mysqli_fetch_assoc($retrieveproductdataResult);

                $product_name = $productrow['product_name'];
                $image_path = $productrow['image_path'];
                $quantity = $productrow['quantity'];
                $description = $productrow['description'];
                $category = $productrow['category'];
                $price = $productrow['price'];
                $product_id = $productrow['product_id'];
                $seller_id = $productrow['seller_id'];

                $productPrice = $cart_quantity * $price;
                $totalPrice += $productPrice;

                $checkorderQuery = "SELECT * FROM cart WHERE user_id = '$user_id'";
                $checkorderResult = mysqli_query($conn, $checkorderQuery);
                $ordernumberRow = mysqli_fetch_assoc($checkorderResult);
                $order_number = $ordernumberRow['order_number'];

                $insertOrderDetailsQuery = "INSERT INTO order_details (order_number, product_id, quantity, price, product_subtotal, user_id, order_status) 
                VALUES ('$order_number', '$product_id', '$cart_quantity', '$price', '$productPrice','$user_id', 'Waiting for confirmation')";
                mysqli_query($conn, $insertOrderDetailsQuery);
            }
        $flushcartQuery = "DELETE FROM cart WHERE user_id = '$user_id'";
        $flushcartResult = mysqli_query($conn, $flushcartQuery);
        header("location: ../order/order.php");
    }
}
