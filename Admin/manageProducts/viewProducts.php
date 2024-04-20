<?php

if (isset($_POST['view'])) {
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "susmarketplace";

    $user_id = $_POST['user_id'];

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }

    $viewQuery = "SELECT * FROM product_seller_view WHERE seller_id = '$user_id'";
    $viewResult = mysqli_query($conn, $viewQuery);

    if (mysqli_num_rows($viewResult) > 0) {
        while ($row = mysqli_fetch_assoc($viewResult)) {
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $price = $row['price'];
            

            echo "User Email: $user_email, Seller Store Name: $seller_store_name <br>";
        }
    } else {
        echo "No results found.";
    }

    mysqli_close($conn);
}
?>
