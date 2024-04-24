<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script src="https://kit.fontawesome.com/2cbd32f941.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .left,
        .middle,
        .right {
            flex: 1;
            margin: 10px;
        }

        .product-image {
            width: 400px;
            height: auto;
        }


        .order-card {
            border: 1px solid grey;
            padding: 20px;
            border-radius: 10px;
        }

        .quantity,
        .notes {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        .cart-button,
        .buy-button {
            border-radius: 10px;
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            color: white;
            box-shadow: 0px 14px 32px 0px rgba(0,0,0,0.57);
-webkit-box-shadow: 0px 14px 32px 0px rgba(0,0,0,0.57);
-moz-box-shadow: 0px 14px 32px 0px rgba(0,0,0,0.57);
            cursor: pointer;
        }
        
    </style>
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
                            <p><i class="fa-solid fa-cash-register" style="color: darkgreen;"></i> Quantity Sold: 70</p>
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
                            </div>
                        </div>
                    </div>
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
</body>

</html>