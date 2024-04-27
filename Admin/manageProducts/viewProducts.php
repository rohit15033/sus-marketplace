<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link rel="stylesheet" href="../admin-template.css">
    <style>
        .product-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
        }
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-info-container {
            padding: 10px 0;
        }
        .product-name {
            margin: 5px 0;
        }
        .price, .quantity {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .action-buttons {
            margin-top: 10px;
        }
        .action-buttons input {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .action-buttons input:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_POST['view'])) {
        $seller_id = $_POST['seller_id'];
        require '../../connect.php';

        $viewQuery = "SELECT * FROM product_seller_view WHERE seller_id = '$seller_id'";
        $viewResult = mysqli_query($conn, $viewQuery);

        if (mysqli_num_rows($viewResult) > 0) {
            while ($row = mysqli_fetch_assoc($viewResult)) {
                $product_name = $row['product_name'];
                $image_path = $row['image_path'];
                $quantity = $row['quantity'];
                $description = $row['description'];
                $category = $row['category'];
                $price = $row['price'];
                $product_id = $row['product_id'];
                $seller_id = $row['seller_id'];
    ?>
                <div class='product-card'> 
                    <img src='<?php echo $image_path ?>' alt='<?php echo $product_name ?>'>
                    <div class='product-info-container'>
                        <h2 class='product-name'><?php echo $product_name ?></h2>
                        <h2 class='price'>Price: <?php echo $price ?></h2>
                        <h2 class='quantity'>Qty: <?php echo $quantity ?></h2>
                        <div class='action-buttons'>
                            <form method='POST' action='deleteProducts.php'>
                                <input type='hidden' value='<?php echo $product_id ?>' name='product_id'>
                                <input type='hidden' value='<?php echo $seller_id ?>' name='seller_id'>
                                <input type='submit' value='Delete' name='delete'>
                            </form>
                            <form method='POST' action='updateProduct.php'>
                                <input type='hidden' value='<?php echo $product_id ?>' name='product_id'>
                                <input type='hidden' value='<?php echo $seller_id ?>' name='seller_id'>
                                <input type='submit' value='Update Product' name='update'>
                            </form>
                        </div>
                    </div>
                </div>
    <?php
            }
        } else {
            echo "No results found.";
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
