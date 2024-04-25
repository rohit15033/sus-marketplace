   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/2cbd32f941.js" crossorigin="anonymous"></script>
    <style>
    .root{
    --height: 10vh;
    --width: 10vh;
    --border-radius: 20px;
    --productoftheday-img-size : 50vh;
    --products-img-size : 25vh;
}

.productoftheday-container
{
    position: relative;
    left: 55vh;
    display: flex;
    flex-direction: row;  
    /* justify-content: center; */
    border-radius: 10px;
    /* border: solid black 5px; */
    width: fit-content;
    height: 61vh;
    align-items: center;
    box-shadow: 2px 3px 36px -6px rgba(0,0,0,0.75);
    -webkit-box-shadow: 2px 3px 36px -6px rgba(0,0,0,0.75);
    -moz-box-shadow: 2px 3px 36px -6px rgba(0,0,0,0.75);
}

.productoftheday{
    margin-bottom: 11vh;
}

.productoftheday-container h2
{
    width:20vh;
    font-size: 20px;
}



.productoftheday-container h3
{
    font-size: 15px;
}

.productoftheday-container h1
{
    margin-left: 2vh;
}

.productoftheday-container img
{
    border-radius: 10px;
    width: 46vh;
    height: 41vh;
}

.productoftheday {
    position: relative;
    left: 2.5vh;
}

.productoftheday

.productoftheday-price {
    position: absolute;
    left: 33vh;
    top: 1.3vh
}

.productoftheday-name h2
{
    font-size: 30px;
    font-weight: lighter;
}

.product {
    position: relative;
}

.price {
    position: absolute;
    right: 2vh;
}

.product-details{
    display: flex;
    flex-direction: row;
    gap: 20vh;
    position: relative;
    bottom: 7px;
    height: 1vh;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    box-shadow: 2px 3px 36px -6px rgba(0,0,0,0.75);
    -webkit-box-shadow: 2px 3px 36px -6px rgba(0,0,0,0.75);
    -moz-box-shadow: 2px 3px 36px -6px rgba(0,0,0,0.75);
    padding: none;
}

.products
{
    margin-left: 5vh;
    /* border: solid black 5px; */
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: auto;
    height: 61vh;
    grid-column-gap: 20px;
}

.products > div:nth-child(1) img {
    border-top-left-radius: 20px;
  }
  
  .products > div:nth-child(2) img {
    border-top-right-radius: 20px;
  }
  .products > div:nth-child(3) img {
    border-bottom-left-radius: 20px;
  }
  
  .products > div:nth-child(4) img {
    border-bottom-right-radius: 20px;
  }

.products img
{
    width: 22.8vh;
    height: 22.8vh;
}

.product-namespace{
    margin-left: 5vh;
}

.productoftheday-name
{
    font-weight: bold;
    margin-left: 3vh;
    position: relative;
    bottom: 1vh;
}

.product-name
{
    margin-left: 1.5vh;
    position: relative;
    bottom: 0.5vh;
}

.product-name h3
{
    font-weight: lighter;
    font-size: 17px;
}
        </style>
   </head>
   <body>
    
   </body>
   </html>

   <?php
    require '../../connect.php';

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
                    echo "<h1>Product Of The Day</h1>";
                    echo "<div class='product'>";
                    echo "<a href='../product/product.php?product_id=$product_id'>";
                    echo "<img src='$image_path' alt='$product_name'>";
                    echo "<div class = 'product-details'>";
                    echo "<div class = 'productoftheday-name'>";
                    echo "<h2>$product_name</h2>";
                    echo "</div>";
                    // echo "<div class='productoftheday-price'>";
                    // echo "<h2 class = 'product-price'><i class='fas fa-dollar-sign'></i>$price</h2>";
                    // echo "</div>";
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
                echo "<div class = 'product-name'>";
                echo "<h3>$product_name</h3>";
                echo "</div>";
                echo "<div class='price'>";
                echo "<h3><i class='fas fa-dollar-sign'></i>$price</h3>";
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