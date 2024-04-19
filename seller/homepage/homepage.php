<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
<a href="../logout/logout.php">Logout</a> <br>

<a href="../createProduct/createProduct.html">Create Product</a><br>

<a href="../order/order.php">View orders</a>

<div class='homepage.css'></div>

<?php
session_start();
$seller_id = $_SESSION['seller_id'];

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "susmarketplace";
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$getQuery = "SELECT * FROM product_seller_view where seller_id = '$seller_id'";
$Result = mysqli_query($conn, $getQuery);
?>

My products

<div class = 'product-container'>
<?php
while ($row = mysqli_fetch_assoc($Result)) 
{
    $product_name = $row['product_name'];
    $image_path = $row['image_path'];
    $quantity = $row['quantity'];
    $description = $row['description'];
    $category = $row['category'];
    $price = $row['price'];
    $product_id = $row['product_id'];

    $getQuery = "SELECT COUNT(*) AS total_orders FROM order_details_view WHERE seller_id = '$seller_id' AND product_id = '$product_id'";
    $countResult = mysqli_query($conn, $getQuery);

    if ($countResult) {
        $countRow = mysqli_fetch_assoc($countResult);
        $order_count = $countRow['total_orders'];
    } else {
        $order_count = 0;
    }

    echo "<div class='product-card'> 
    <a href='../updateProduct/updateProduct.php?product_id=$product_id'>
        <img src='$image_path' alt='$product_name'>
        <div class='product-info-container'>
            <h2 class='product-name'>$product_name</h2>
            <h2 class='price'>Price: $price</h2>
            <h2 class='quantity'>Qty: $quantity</h2>
            <h2 class='order-count'>Orders: $order_count</h2>
        </div>
    </a>
</div>";
}
?>
</div> 
</body>
</html>