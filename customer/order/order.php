My orders
<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "susmarketplace";
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];

    $getorderdataQuery = "SELECT * FROM order_details_view WHERE user_id = '$user_id'";
    $getorderdataResult = mysqli_query($conn, $getorderdataQuery);
    
    while ($orderdetailRow = mysqli_fetch_assoc($getorderdataResult)) {
        $product_name = $orderdetailRow['product_name'];
        $quantity = $orderdetailRow['quantity'];
        $category = $orderdetailRow['category'];
        $price = $orderdetailRow['price'];
        $image_path = $orderdetailRow['image_path'];
        $productSubtotal = $orderdetailRow['product_subtotal'];
        $order_status = $orderdetailRow['order_status'];
    
        echo "<div class='product'>";
        echo "<img src='$image_path' alt='$product_name' style='max-width: 200px; max-height: 200px;'>";
        echo "<h2>$product_name</h2>";
        echo "<h2>$quantity</h2>";
        echo "<h2>$category</h2>";
        echo "<h2>$price</h2>";
        echo "<h2>$productSubtotal</h2>";
        echo "<h2>$order_status</h2>";
        echo "</div>";
    }
    
}
