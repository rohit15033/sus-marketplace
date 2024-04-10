My Cart
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
    $totalPrice = 0;

    $viewcartQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
    $viewcartResult = mysqli_query($conn, $viewcartQuery);
    $counter = 1;

    while ($cartrow = mysqli_fetch_assoc($viewcartResult)) {

        $cart_quantity = $cartrow['quantity'];
        $product_id = $cartrow['product_id'];

        $retrieveproductdataQuery = "SELECT * FROM products where id = '$product_id'";
        $retrieveproductdataResult = mysqli_query($conn, $retrieveproductdataQuery);
        $productrow = mysqli_fetch_assoc($retrieveproductdataResult);

        $product_name = $productrow['product_name'];
        $image_path = $productrow['image_path'];
        $quantity = $productrow['quantity'];
        $description = $productrow['description'];
        $category = $productrow['category'];
        $price = $productrow['price'];
        $product_id = $productrow['id'];
        $seller_id = $productrow['seller_id'];

        $productPrice = $cart_quantity * $price;
        $totalPrice += $productPrice;

        echo "<div class='product'>";
        echo "<img src='$image_path' alt='$product_name' style='max-width: 200px; max-height: 200px;'>";
        echo "<h2>$product_name</h2>";
        echo "<h2>$quantity</h2>";
        echo "<h2>$category</h2>";
        echo "<h2 id='price_$counter'>$price</h2>";

        echo "<form method='POST' action='cart.php'>";
        echo "<input type='button' value='+' id='add_$counter'>";
        echo "<input type='number' value='$cart_quantity' id='quantity_$counter' name='new_quantity[$product_id]'>";

        echo "<input type='button' value='-' id='subtract_$counter'>";
        echo "<h2> Price: </h2>";
        echo "<h2 id='product_price_$counter'>$productPrice</h2>";
        echo "</div>";

        $counter++;
    }
    echo "<h2 id='total_price'> Total: $totalPrice </h2>";
    echo "<input type='submit' name='update_cart' value='Update Cart'>";
    echo "<input type='submit' name='order' value='Order Now'>";
    echo "</form>";
}
?>

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
        document.getElementById("total_price").innerText = "Total: " + newTotalPrice;
    }
</script>