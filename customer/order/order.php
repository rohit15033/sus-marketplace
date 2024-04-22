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

                    require '../../connect.php';

                    $user_id = $_SESSION['user_id'];

                    $getorderdataQuery = "SELECT * FROM order_details_view WHERE user_id = '$user_id' ORDER BY seller_name";
                    $getorderdataResult = mysqli_query($conn, $getorderdataQuery);

                    if (mysqli_num_rows($getorderdataResult) == 0) {
                        echo "<p>You have no orders. <a href='#' onclick='submitSearch()'>Start shopping now</a>.</p>";
                    } else {

                        $current_seller_name = null;

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

                            if ($seller_name != $current_seller_name) {
                                if ($current_seller_name !== null) {
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "<div class='seller-container-inner'>";
                                echo "<div class='seller-container-top'>";
                                echo "<div class='seller-name-container'>";
                                echo "<h2 id='seller-name'>$seller_name</h2>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='seller-container-bottom'>";
                                $current_seller_name = $seller_name;
                            }

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

                        if ($current_seller_name !== null) {
                            echo "</div>";
                            echo "</div>";
                        }

                        echo "</div>";
                    }
                }
                ?>
            </div>

        </div>
    </body>

    </html>


    <script>
        function submitSearch() {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '../search/search.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'search';
            input.value = '';

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>