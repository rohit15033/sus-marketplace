<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    if (isset($_GET['product_id'])) {

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $product_id = $_GET['product_id'];
        $getQuery = "SELECT * FROM products WHERE id = '$product_id'";
        $Result = mysqli_query($conn, $getQuery);


        if ($Result && mysqli_num_rows($Result) > 0) {
            $row = mysqli_fetch_assoc($Result);
            $product_name = $row['product_name'];
            $image_path = $row['image_path'];
            $quantity = $row['quantity'];
            $description = $row['description'];
            $category = $row['category'];
            $price = $row['price'];
            $product_id = $row['id'];
            $seller_id = $row['seller_id'];


            echo "<div class='product'>";
            echo "<img src='$image_path' alt='$product_name' style='max-width: 200px; max-height: 200px;'>";
            echo "<h2>$product_name</h2>";
            echo "<h2>$quantity</h2>";
            echo "<h2>$category</h2>";
            echo "<h2>$price</h2>";
            echo "<h2>$description</h2>";
            echo "</div>";
?>

            <form method="POST" action="../cart/cart.php">
                <input type="hidden" name="product_id" value = <?php echo "$product_id" ?> >
                <input type="button" id="add" value = "+"> <br>
                <input type="number" id="quantity" name="quantity" value="0" ;> <br>
                <input type="button" id="substract" value = "-">

                <input type="submit" name="add_to_cart" value="Add to cart">
            </form>

<?php

        } else {
            echo "No product found with the given ID.";
        }

        mysqli_close($conn);
    } else {
        echo "No product ID provided.";
    }
} else {
    header("Location: ../login/login.php");
    exit();
}
?>

<script>
    var add = document.getElementById("add");
    var subtract = document.getElementById("substract");
    var quantity = document.getElementById("quantity");

    add.addEventListener("click", function() {
        quantity.value = parseInt(quantity.value) + 1;
    });

    subtract.addEventListener("click", function() {
        if (parseInt(quantity.value) > 0) {
            quantity.value = parseInt(quantity.value) - 1;
        }
    });
</script>