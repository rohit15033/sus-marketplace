<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="shomepage.css">
</head>

<body>

    <div class="global-container">

        <header>
            <div class="logo-container">
                <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
            </div>
        </header>
        
        <aside class="sidebar-container">
                <nav class="sidebar">
                    <div><a href="../createProduct/createProduct.html" class="button">- Create Product</a></div>

                    <div><a href="../logout/logout.php" class="button">- Logout</a></div>
                    <div><a href="../order/order.php" class="button">- Orders</a></div>
                </nav>
        </aside>
        <div class="header-accent"></div>

        <?php
        session_start();
        $seller_id = $_SESSION['seller_id'];

        require '../../connect.php';

        $getQuery = "SELECT * FROM product_seller_view where seller_id = '$seller_id'";
        $Result = mysqli_query($conn, $getQuery);
        ?>



        <div class='product-container'>
            <?php
            while ($row = mysqli_fetch_assoc($Result)) {
                $product_name = $row['product_name'];
                $image_path = $row['image_path'];
                $quantity = $row['quantity'];
                $description = $row['description'];
                $category = $row['category'];
                $price = $row['price'];
                $product_id = $row['product_id'];

                $getQuery = "SELECT COUNT(*) AS total_orders FROM order_details_view WHERE seller_id = '$seller_id' AND product_id = '$product_id'";
                $countResult = mysqli_query($conn, $getQuery);

                if ($countResult) {
                    $countRow = mysqli_fetch_assoc($countResult);
                    $order_count = $countRow['total_orders'];
                } else {
                    $order_count = 0;
                }

                echo "<div class='product'> 
                <a href='../updateProduct/updateProduct.php?product_id=$product_id'>
                <img src='$image_path' alt='$product_name'>
                <div class='product-info-container'>
                <p class='product-name'>$product_name</p>
                <p class='price'>Price: $price</hp>
                <p class='quantity'>Qty: $quantity</p>
                <p class='order-count'>Orders: $order_count</p>
            </div>
        </a>
    </div>";
            }
            ?>
        </div>
    </div>

</body>

</html>