<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="order.css">
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
        </div>
    </header>
    <div class="global-container">

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

            $getorderdataQuery = "SELECT * FROM order_details_view WHERE user_id = '$user_id' ORDER BY seller_name";
            $getorderdataResult = mysqli_query($conn, $getorderdataQuery);
            $current_seller_name = null;

            while ($orderdetailRow = mysqli_fetch_assoc($getorderdataResult)) {
                $product_name = $orderdetailRow['product_name'];
                $quantity = $orderdetailRow['quantity'];
                $category = $orderdetailRow['category'];
                $price = $orderdetailRow['price'];
                $image_path = $orderdetailRow['image_path'];
                $productSubtotal = $orderdetailRow['product_subtotal'];
                $order_status = $orderdetailRow['order_status'];
                $seller_name = $orderdetailRow['seller_name'];
                if ($seller_name != $current_seller_name) {
                    echo "<h2>$seller_name</h2>";
                    $current_seller_name = $seller_name;
                }

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

        ?>

    </div>
</body>

</html>