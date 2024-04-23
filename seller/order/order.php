<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="order-seller.css">
</head>

<body>

    <div class="container">

        <header>
            <div class="logo-container">
                <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
            </div>
            <!-- Add the search bar here -->
            <div class="search-container">
                <form action="" method="POST">
                    <input type="text" name="search" placeholder="Search by order ID or seller email">
                    <button type="submit" name="submit_search">Search</button>
                </form>
            </div>
        </header>

        <aside class="sidebar-container">
            <nav class="sidebar">
                <div><a href="../createProduct/createProduct.html" class="button">- Create Product</a></div>

                <div><a href="../logout/logout.php" class="button">- Logout</a></div>

            </nav>
        </aside>
        <div class="header-accent"></div>
        <main>

            <div class="product-container">
                <form method="POST" action="updateOrder.php">
                    <?php
                    session_start();

                    require '../../connect.php';

                    if (isset($_SESSION['seller_logged_in']) && $_SESSION['seller_logged_in'] === true) {
                        $seller_id = $_SESSION['seller_id'];

                        $fetchorderdetailsQuery = "SELECT * FROM order_details_view WHERE seller_id = '$seller_id'";
                        $fetchorderdetailsResult = mysqli_query($conn, $fetchorderdetailsQuery);

                        while ($orderdetailsrow = mysqli_fetch_assoc($fetchorderdetailsResult)) {
                            $image_path = $orderdetailsrow['image_path'];
                            $product_name = $orderdetailsrow['product_name'];
                            $order_number = $orderdetailsrow['order_number'];
                            $order_date = $orderdetailsrow['order_date'];
                            $quantity = $orderdetailsrow['quantity'];
                            $price = $orderdetailsrow['price'];
                            $product_subtotal = $orderdetailsrow['product_subtotal'];
                            $user_email = $orderdetailsrow['user_email'];
                            $order_status = $orderdetailsrow['order_status'];
                            $product_id = $orderdetailsrow['product_id'];
                            ?>
                            <div class='product'>
                                <img src='<?php echo $image_path; ?>' alt='<?php echo $product_name; ?>' class='product-image'>
                                <div class='product-info-container'>
                                    <h2>Order Number: <?php echo $order_number; ?></h2>
                                    <p class="product-name">Product: <?php echo $product_name; ?></p>
                                    <p class="quantity">Quantity: <?php echo $quantity; ?></p>
                                    <p class="price">Price: <?php echo $price; ?></p>
                                    <p class="subtotal">Subtotal: <?php echo $product_subtotal; ?></p>
                                    <p class="order-date">Date: <?php echo $order_date; ?></p>
                                    <p class="user-email">User Email: <?php echo $user_email; ?></p>
                                    <select name="order_status[]">
                                        <option value="<?php echo $order_status; ?>"><?php echo $order_status; ?></option>
                                        <option value="Processing">Processing</option>
                                        <option value="Ready for Pickup">Ready for Pickup</option>
                                        <option value="Cancelled">Cancel</option>
                                    </select>
                                </div>
                                <input type="hidden" value="<?php echo $order_number; ?>" name="order_number[]">
                                <input type="hidden" value="<?php echo $product_id; ?>" name="product_id[]">
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="submit-button-container">
                        <input type="submit" value="Update Status">
                    </div>
                </form>
            </div>
        </main>

    </div>

</body>

</html>
