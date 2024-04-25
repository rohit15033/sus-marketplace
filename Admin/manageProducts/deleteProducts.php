<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
    if (isset($_POST['delete']))
    {
        require '../../connect.php';
        
        $product_id = $_POST['product_id'];
        $deleteProductQuery1 = "DELETE FROM products WHERE id = '$product_id'";
        $deleteResult = mysqli_query($conn, $deleteProductQuery1);
        $deleteProductQuery2 = "DELETE FROM product_seller_junction WHERE product_id = '$product_id' AND seller_id = '$seller_id'";
        $deleteResult = mysqli_query($conn, $deleteProductQuery2);
        header("location: viewProducts.php");
    }
?>

</body>
</html>