<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="orderstuff.css">
</head>

<body>

    <div class="global-container">

        <div class="header">
            <div class='logo-container'>
                <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
            </div>
        </div>
        <div class="header-accent"></div>

        <div class="product-container">
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

                // Open the first seller-container outside the loop
                echo "<div class='seller-container'>";

                while ($orderdetailRow = mysqli_fetch_assoc($getorderdataResult)) {
                    $product_name = $orderdetailRow['product_name'];
                    $quantity = $orderdetailRow['quantity'];
                    $category = $orderdetailRow['category'];
                    $price = $orderdetailRow['price'];
                    $image_path = $orderdetailRow['image_path'];
                    $productSubtotal = $orderdetailRow['product_subtotal'];
                    $order_status = $orderdetailRow['order_status'];
                    $seller_name = $orderdetailRow['seller_name'];

                    // Check if seller name has changed
                    if ($seller_name != $current_seller_name) {
                        // Close previous seller-container-bottom if it's not the first one
                        if ($current_seller_name !== null) {
                            echo "</div>"; // Close seller-container-bottom
                            echo "</div>"; // Close seller-container
                        }
                        // Start new seller-container
                        echo "<div class='seller-container-inner'>";
                        echo "<div class='seller-container-top'>";
                        echo "<div class='seller-name-container'>";
                        echo "<h2 id='seller-name'>$seller_name</h2>";
                        echo "</div>";
                        echo "</div>";
                        // Open new seller-container-bottom
                        echo "<div class='seller-container-bottom'>";
                        $current_seller_name = $seller_name;
                    }

                    // Print product information
                    echo "<div class='product'>";
                    echo "<div class='product-img-div'>";
                    echo "<img src='$image_path' alt='$product_name' style='max-width: 200px; max-height: 200px;'>";
                    echo "</div>";
                    echo "<div class='product-detail'>";
                    echo "<p id='product-name'>$product_name</p>";
                    echo "<p id='product-quantity'>$quantity</p>";
                    echo "<p id='product-category'>$category</p>";
                    echo "<p id='product-price'>$price</p>";
                    echo "<p id='product-subtotal'>$productSubtotal</p>";
                    echo "</div>";
                    echo "<p id='order-status'>$order_status</p>";
                    echo "</div>";
                }

                // Close the last seller-container-bottom and seller-container
                if ($current_seller_name !== null) {
                    echo "</div>"; // Close seller-container-bottom
                    echo "</div>"; // Close seller-container
                }

                // Close the first seller-container
                echo "</div>";
            }
            ?>



        </div>

    </div>
</body>

</html>