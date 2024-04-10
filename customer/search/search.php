<?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    if (isset($_POST['search'])) {

        $email = $_SESSION['email'];

        $db_host = "localhost";
        $db_username = "$email";
        $db_password = "";
        $db_name = "susmarketplace";
    
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $search = $_POST['search'];

        echo "<div class='product-container'>";

        $searchQuery = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
        $searchResult = mysqli_query($conn, $searchQuery);

        while ($row = mysqli_fetch_assoc($searchResult)) {
            $product_name = $row['product_name'];
            $image_path = $row['image_path'];
            $quantity = $row['quantity'];
            $description = $row['description'];
            $category = $row['category'];
            $price = $row['price'];
            $product_id = $row['id'];
            $seller_id = $row['seller_id'];

            echo "<div class='product'>";
            echo "<a href='../product/product.php?product_id=$product_id'>";
            echo "<img src='$image_path' alt='$product_name' style='max-width: 200px; max-height: 200px;'>";
            echo "<h2>$product_name</h2>";
            echo "<h2>$quantity</h2>";
            echo "<h2>$category</h2>";
            echo "<h2>$price</h2>";
            echo "</div>";
        }

        echo "</div>";

    } else {
        header("Location: search.php");
        exit(); 
    }
} else {
    header("Location: ../login/login.php");
    exit(); 
}
?>
