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


            echo "<div class='product-card'> 
            <img src='$image_path' alt='$product_name'>
            <div class='product-info-container'>
            <h2 class='product-name'>$product_name</h2>
            <h2 class='price'>Price: $price</h2>
            <h2 class='quantity'>Qty: $quantity</h2>
            
            <form method = 'POST' action = 'deleteProducts.php'>
            <input type = 'hidden' value= '$product_id' name = 'product_id'>
            <input type = 'submit' value = 'Delete' name = 'delete'>
        </form>
        <form method = 'POST' action = 'updateProduct.php'>
            <input type = 'hidden' value= '$product_id' name = 'product_id'>
            <input type = 'submit' value = 'Update Product' name = 'update'>
        </form>";
        }
    } else {
        echo "No results found.";
    }

    mysqli_close($conn);
}
?>