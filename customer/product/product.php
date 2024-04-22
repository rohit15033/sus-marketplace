<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/2cbd32f941.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        if (isset($_GET['product_id'])) {

            require '../../connect.php';

            $product_id = $_GET['product_id'];
            $getQuery = "SELECT * FROM product_seller_view WHERE product_id = '$product_id'";
            $Result = mysqli_query($conn, $getQuery);


            if ($Result && mysqli_num_rows($Result) > 0) {
                $row = mysqli_fetch_assoc($Result);
                $product_name = $row['product_name'];
                $image_path = $row['image_path'];
                $quantity = $row['quantity'];
                $description = $row['description'];
                $category = $row['category'];
                $price = $row['price'];
                $product_id = $row['product_id'];
                $seller_id = $row['seller_id'];
    ?>
                <form method="POST" action="../cart/cart.php">
                    <div class="container">
                        <div class="left">
                            <img src="<?php echo "$image_path" ?>" class="product-image">
                        </div>
                        <div class="middle">
                            <h2><i class="fas fa-tag"></i> <?php echo "$product_name" ?></h2>
                            <p><i class="fa-solid fa-cash-register" style="color: darkgreen;"></i> Quantity Sold: 69</p>
                            <h1><i class="fas fa-dollar-sign"></i><?php echo "$price" ?></h1>
                            <hr>
                            <h4><i class="fas fa-list-ul"></i> Details:</h4>
                            <div>
                                <p><?php echo "$description" ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="order-card">
                            <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                                <label class="quantity-label"><i class="fas fa-sort-numeric-up"></i> Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="0" class="quantity">

                                <input type="button" id="add" value="+">
                                <label class="notes-label"><i class="fas fa-sticky-note"></i> Notes:</label>
                                <input type="button" id="substract" value="-">

                                <textarea rows="2" cols="20" class="notes">Add notes</textarea>
                                <h3><?php echo "$quantity" ?> Pcs lefts !!!</h3>
                                <button type="submit" name="add_to_cart" class="cart-button" style="background-color: #2A05FA;"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                                <button type='submit' name="order" class="buy-button" style="background-color: #6146F8;"><i class="fas fa-shopping-bag"></i> Buy Now</button>
                </form>
                </div>
                </div>
                </div>
</body>

</html>

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