   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="productOfTheDay.css">
   </head>
   </html>
   
   <?php
    session_start();
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "susmarketplace";
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $getQuery = "SELECT * FROM product_seller_view ORDER BY RAND() LIMIT 5";
    $Result = mysqli_query($conn, $getQuery);
    ?>

    <div class='productoftheday-container'>
        <?php
        $counter = 1;
        if (mysqli_num_rows($Result) > 0) {
            while ($row = mysqli_fetch_assoc($Result)) {
                $product_name = $row['product_name'];
                $image_path = $row['image_path'];
                $quantity = $row['quantity'];
                $description = $row['description'];
                $category = $row['category'];
                $price = $row['price'];
                $product_id = $row['product_id'];
                $seller_id = $row['seller_id'];

                if ($counter == 1) {
                    echo "<div class='productoftheday'>";
                    echo "<h1> Product Of The Day</h1>";
                    echo "<div class='product'>";
                    echo "<a href='../product/product.php?product_id=$product_id'>";
                    echo "<img src='$image_path' alt='$product_name'>";
                    echo "<div class = 'product-details'>";
                    echo "<div>";
                    echo "<h2>$product_name</h2>";
                    echo "</div>";
                    echo "<div class='productoftheday-price'>";
                    echo "<h2>$price</h2>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    $counter++;
                    continue;
                }
                
                if ($counter == 2)
                {
                    echo "<div class = 'products'>";
                }
                
                echo "<div class='product'>";
                echo "<a href='../product/product.php?product_id=$product_id'>";
                echo "<img src='$image_path' alt='$product_name' >";
                echo "<div class = 'product-details'>";
                echo "<div>";
                echo "<h2>$product_name</h2>";
                echo "</div>";
                echo "<div class='price'>";
                echo "<h2>$price</h2>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                
                if ($counter == 5)
                {
                    echo "</div>";
                }
                $counter++;
            }
        }
        ?>
    </div>