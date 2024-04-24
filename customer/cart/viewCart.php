<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <script src="https://kit.fontawesome.com/2cbd32f941.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins';
        }

        :root {
            --primary-colour: #2A05FA;
            --secondary-colour: #13DBDB;
            --background-colour: white;
            --accent-colour: #6146F8;
        }

        .global-container {
            margin: 0;
            width: 100%;
            height: fit-content;
            justify-content: center;
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
            z-index: 2;
            background-color: var(--primary-colour);
        }

        .header-logo {
            position: relative;
            top: 6px;
            left: 50%;
            width: 150px;
            height: 40px;
            z-index: 300;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            overflow: hidden;
            object-fit: cover;
            object-position: center;
        }

        .header-accent {
            background-color: var(--secondary-colour);
            position: relative;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            width: 100%;
            height: 45px;
            top: -20px;
            line-height: 85px;
            z-index: 0;
            text-align: center;
            font-size: small;
            font-family: sans-serif;
        }

        .cart-container {
            display: flex;
            position: relative;
            left: 6%;
            width: 85%;
            border-radius: 20px;
            margin-bottom: 20px;
            /* Add margin to separate from the footer */
        }

        .cart-items-container {
            display: flex;
            flex-direction: column;
            position: relative;
            width: 60%;
            left: 30px;
            flex-wrap: wrap;
            /* border: solid darkgray 9px; */
            border-radius: 20px;
            padding: 20px;
        }

        .cart-actions {
            -webkit-box-shadow: 0px 10px 15px -4px rgba(0, 0, 0, 0.72);
            -moz-box-shadow: 0px 10px 15px -4px rgba(0, 0, 0, 0.72);
            box-shadow: 0px 10px 15px -4px rgba(0, 0, 0, 0.72);
            position: fixed;
            /* Change to fixed */
            font-family: 'Inter', sans-serif;
            font-weight: lighter;
            width: 200px;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            top: 42.5vh;
            left: 150vh;
        }

        .ultimate-product-container {
            text-align: center;
            display: flex;
            flex-direction: column;
            position: relative;
            padding: 0;
            margin: 10px;
            width: 100vh;
            /* border: solid blue 1px; */
            border-radius: 5px;
            justify-items: center;
            -webkit-box-shadow: 0px 10px 15px -4px rgba(0, 0, 0, 0.72);
            -moz-box-shadow: 0px 10px 15px -4px rgba(0, 0, 0, 0.72);
            box-shadow: 0px 10px 15px -4px rgba(0, 0, 0, 0.72);
        }

        .product-container {
            display: flex;
            flex-direction: row;
        }

        .product-name {
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-left: 5vh;
        }

        .product-name h1 {
            position: relative;
            top: 2vh;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 24px;
            /* border: solid red 1px; */
            align-items: center;
        }

        .product-name p {
            position: relative;
            bottom: 2.5vh;
            font-family: 'Poppins', sans-serif;
            font-weight: lighter;
            font-size: 16px;
            /* border: solid red 1px; */
            align-items: center;
        }

        .product-container img {
            justify-content: center;
        }

        .price-cart-container {
            display: flex;
            flex-direction: row;
            position: relative;
            left: 8vh;
            top: 8vh
        }

        .price-cart-container input[type="number"] {
            width: 6vh;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            /* Add rounded corners */
        }

        hr {
            border: none;
            border-top: 1px solid black;
            margin: 1px 0;
        }

        .ultimate-cart-container {
            text-align: center;
            margin-top: 10vh;
        }

        .title {
            font-size: 50px;
        }

        .prices-container {
            position: relative;
            bottom: 10vh;
            left: 30vh;
        }

        .price-cart-container input[type="button"] {
            background-color: var(--primary-colour);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            /* Add some margin between buttons */
        }

        /* Minus button */
        .price-cart-container input[type="button"]:last-child {
            background-color: var(--accent-colour);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cart-actions input[type="submit"] {
        background-color: var(--primary-colour);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px; /* Add margin to separate buttons */
        transition: all 0.3s ease; /* Add smooth transition effect */
    }

    .cart-actions input[type="submit"]:hover {
        background-color: var(--accent-colour);
    }
    </style>

</head>

<body>

    <div class="global-container">
        <?php require "../navbar/navbar.html";?>
        <div class="ultimate-cart-container">
            <p class="Title"><i class="fa-solid fa-cart-shopping"></i> My cart</p>
            <div class="cart-container">
                <div class="cart-items-container">
                    <?php
                    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {

                        require '../../connect.php';

                        $user_id = $_SESSION['user_id'];
                        $totalPrice = 0;

                        $viewcartQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
                        $viewcartResult = mysqli_query($conn, $viewcartQuery);
                        $counter = 1;

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
                            $store_name = $productrow['store_name'];

                            $productPrice = $cart_quantity * $price;
                            echo "
                        <div class='ultimate-product-container'>
                            <h4> <i class='fa-solid fa-store'></i> $store_name </h4>
                            <hr>
                            <div class='product-container'>
                                <img src='$image_path' alt='$product_name' style='width: 20vh; height: 20vh; border-radius: 10px'>
                                <div class='product-name'>
                                    <h1>$product_name</h1>
                                    <p>$category</p>
                                </div>
                                <div class='price-cart-container'>
                                <form method='POST' action='cart.php'>
                                <input type='button' value='+' id='add_$counter'>
                                <input type='number' value='$cart_quantity' id='quantity_$counter' name='new_quantity[$product_id]'>
                                <input type='button' value='-' id='subtract_$counter'>
                            <div class = 'prices-container'>
                            <h2> Price: <span id='product_price_$counter'><i class='fas fa-dollar-sign'></i>$productPrice</span></h2>
                                    <h2 id='price_$counter'><i class='fas fa-dollar-sign'></i>$price</h2>
                                    </div>
                                </div>
                            </div>
                        </div>";



                            $counter++;
                        }
                        echo "<div class='cart-actions'>";
                        echo "<h2 id='total_price'> Total Price: <i class='fas fa-dollar-sign'></i>$totalPrice </h2>";
                        echo "<input type='submit' name='update_cart' value='Update Cart'>";
                        echo " <input type='submit' name='order' value='Order Now'>";
                        echo "</div>";


                        echo "</form>";
                    }



                    ?>
                </div>
            </div>
        </div>

    </div>

    </div>

    <script>
        var totalPrice = <?php echo $totalPrice; ?>;
        var product_prices = [];

        <?php
        for ($i = 1; $i <= $counter; $i++) {
        ?>
            var product_price_<?php echo $i ?> = parseInt(document.getElementById("product_price_<?php echo $i ?>").innerText);
            product_prices.push(product_price_<?php echo $i ?>);

            var quantity_element_<?php echo $i ?> = document.getElementById("quantity_<?php echo $i ?>");
            var quantity_<?php echo $i ?> = parseInt(quantity_element_<?php echo $i ?>.value);
            var product_price_element_<?php echo $i ?> = document.getElementById("product_price_<?php echo $i ?>");
            var price_<?php echo $i ?> = parseInt(document.getElementById("price_<?php echo $i ?>").innerText);

            quantity_element_<?php echo $i ?>.addEventListener("input", function(event) {
                var index = <?php echo $i; ?>;
                quantity_<?php echo $i ?> = parseInt(event.target.value);

                product_price_<?php echo $i ?> = price_<?php echo $i ?> * quantity_<?php echo $i ?>;
                product_price_element_<?php echo $i ?>.innerText = product_price_<?php echo $i ?>;
                product_prices[index - 1] = product_price_<?php echo $i ?>;

                updateTotalPrice();
            });

            var add_<?php echo $i ?> = document.getElementById("add_<?php echo $i ?>");
            var subtract_<?php echo $i ?> = document.getElementById("subtract_<?php echo $i ?>");

            add_<?php echo $i ?>.addEventListener("click", function() {
                var index = <?php echo $i; ?>;

                quantity_<?php echo $i ?> += 1;
                quantity_element_<?php echo $i ?>.value = quantity_<?php echo $i ?>;

                product_price_<?php echo $i ?> = price_<?php echo $i ?> * quantity_<?php echo $i ?>;
                product_price_element_<?php echo $i ?>.innerText = product_price_<?php echo $i ?>;
                product_prices[index - 1] = product_price_<?php echo $i ?>;

                updateTotalPrice();
            });

            subtract_<?php echo $i ?>.addEventListener("click", function() {
                var index = <?php echo $i; ?>;
                if (quantity_<?php echo $i ?> > 0) {

                    quantity_<?php echo $i ?> -= 1;
                    quantity_element_<?php echo $i ?>.value = quantity_<?php echo $i ?>;

                    product_price_<?php echo $i ?> = price_<?php echo $i ?> * quantity_<?php echo $i ?>;
                    product_price_element_<?php echo $i ?>.innerText = product_price_<?php echo $i ?>;
                    product_prices[index - 1] = product_price_<?php echo $i ?>;

                    updateTotalPrice();
                }
            });
        <?php
        }
        ?>

        function updateTotalPrice() {
            var newTotalPrice = 0;
            for (var i = 0; i < product_prices.length; i++) {
                newTotalPrice += product_prices[i];

            }
            document.getElementById("total_price").innerText = "Total:" + newTotalPrice;
        }
    </script>
</body>

</html>