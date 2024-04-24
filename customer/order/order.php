<?php
session_start();
?>

   <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            :root {
                --primary-colour: #2A05FA;
                --secondary-colour: #13DBDB;
                --background-colour: white;
                --accent-colour: #6146F8;
            }

            body {
                margin: 0px;
            }

            .global-container {
                margin: 0;
                width: 100%;
                height: fit-content;
                justify-content: center;
            }

            .logo-container {
                position: relative;
                top: 5px;
                left: 45%;
                width: 150px;
                height: 50px;
                z-index: 300;
            }

            .logo-container img {
                width: 100%;
                height: 100%;
                overflow: hidden;
                object-fit: cover;
                object-position: center;
            }

            .header {
                position: relative;
                display: flex;
                top: 0;
                left: 0;
                margin: 0;
                width: 100%;
                height: 60px;
                border-bottom-left-radius: 20px;
                border-bottom-right-radius: 20px;
                z-index: 3;
                background-color: var(--primary-colour);
            }

            .header-accent {
                background-color: var(--secondary-colour);
                position: absolute;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
                width: 100%;
                height: 55px;
                top: 20px;
                line-height: 85px;
                z-index: -1;
            }

            .product-container {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                gap: 40px;
                width: 100%;
                align-items: center;
                /* border: solid 5px black; */
                margin: 0 auto;
                margin-top: 50px;
            }

            .seller-container {
                display: flex;
                justify-content: center;
                flex-direction: column;
                width: 100%;
                border-radius: 20px;
            }

            .seller-container-inner {
                display: flex;
                flex-direction: column;
                margin: 0% auto;
                margin-bottom: 30px;
                width: 85%;
                border-radius: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                /* Add shadow */
            }

            .seller-name-container {
                position: relative;
                width: 100%;
                height: fit-content;
                width: fit-content;
                left: 10%;
                top: 10%;
            }

            #seller-name {
                font-family: 'Inter', sans-serif;
                color: black;
            }


            .seller-container-bottom {
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
                border-color: darkcyan;
                align-items: center;
            }

            .product {
                width: 40vh;
                margin: 30px;
                height: fit;
                border-radius: 20px;
                align-items: center;
                box-shadow: 0px 2px 5px 1px rgba(0, 0, 0, 0.29);
                -webkit-box-shadow: 0px 2px 5px 1px rgba(0, 0, 0, 0.29);
                -moz-box-shadow: 0px 2px 5px 1px rgba(0, 0, 0, 0.29);
            }

            #order-status {
                font-family: 'Inter', sans-serif;
                font-weight: bold;
                margin: 10px;
            }

            .product-img-div {
                position: relative;
                left: 5vh;
                top: 0%;
                /* width: 100%; */
                height: 200px;
                overflow: hidden;
                /* object-fit: cover;
                object-position: center; */
            }

            .product-img-div img {
                border-radius: 10px;
            }

            .product-img-div img {
                width: 100%;
                height: 100%;
                /* overflow: hidden;
                object-fit: cover;
                object-position: center; */
            }

            .product-detail {
                font-family: 'Inter', sans-serif;
                width: 100%;
                padding: 10px;
            }

            .product-detail p {
                margin: 2px;
            }

            .seller-container-top{
                position: relative;
                right: 13vh;
            }

            .global-container h1{
                position: relative;
                top: 8vh;
                text-align: center;
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    <body>

        <div class="global-container">
            <h1> My Orders </h1>

            <?php
            require '../navbar/navbar.html'; ?>

            <div class="product-container">
                <?php
                if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {

                    require '../../connect.php';

                    $user_id = $_SESSION['user_id'];

                    $getorderdataQuery = "SELECT * FROM order_details_view WHERE user_id = '$user_id' ORDER BY seller_name";
                    $getorderdataResult = mysqli_query($conn, $getorderdataQuery);

                    if (mysqli_num_rows($getorderdataResult) == 0) {
                        echo "<p>You have no orders. <a href='#' onclick='submitSearch()'>Start shopping now</a>.</p>";
                    } else {

                        $current_seller_name = null;
                        echo "<div class = 'global-container'>";
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
                                echo "<h2 id='seller-name'><i class='fa-solid fa-store'></i>: $seller_name</h2>";
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
                            echo "<p id='product-name'>Product: $product_name</p>";
                            echo "<p id='product-category'>Category: $category</p>";
                            echo "<p id='product-price'>Unit Price: $price</p>";
                            echo "<p id='product-subtotal'>Product Subtotal: $productSubtotal</p>";
                            echo "</div>";
                            echo "<p id='order-status'>$order_status</p>";
                            echo "</div>";
                        }

                        if ($current_seller_name !== null) {
                            echo "</div>";
                            echo "</div>";
                        }

                        echo "</div>";
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