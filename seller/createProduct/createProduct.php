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

    $product_name = $_POST["product_name"];
    $product_id = uniqid();
    $price = $_POST["price"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $seller_id = $_SESSION['seller_id'];


    $target_dir = "../../productImages/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    
    $image_path = $target_file;

    
    $insertproductselleridQuery = "INSERT INTO product_seller_junction (product_id, seller_id) VALUES ('$product_id', '$seller_id')";
    $insertproductselleridResult = mysqli_query($conn, $insertproductselleridQuery);

    $insertproductdataQuery = "INSERT INTO products (product_name, id, price, category, description, quantity, image_path) VALUES ('$product_name', '$product_id', '$price', '$category', '$description', '$quantity', '$image_path')";
    $insertproductdataresult = mysqli_query($conn, $insertproductdataQuery);


    header("location: ../homepage/homepage.php")
?>