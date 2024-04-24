<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <script src="https://kit.fontawesome.com/2cbd32f941.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="cart.css">


</head>

<body>
    <div class="global-container">
        <?php require "../navbar/navbar.html"; ?>
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
                                <input type='button' value='-' id='subtract_$counter'>
                                <input type='number' value='$cart_quantity' id='quantity_$counter' name='new_quantity[$product_id]'>
                                <input type='button' value='+' id='add_$counter'>
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
                        if (isset($_SESSION['invalid_stock']))
                        {
                            echo "<p style='color: red; font-weight: bold'>".$_SESSION['invalid_stock']."</p>";
                            unset($_SESSION['invalid_stock']);
                        }
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