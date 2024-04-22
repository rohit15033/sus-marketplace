    <?php
    session_start();

    require '../../connect.php';

    $seller_id = $_SESSION['seller_id'];
    $product_name = $_POST["product_name"];
    $product_id = $_POST['product_id'];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];


    $target_dir = "../../productImages/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);


    $image_path = $target_file;
    $updateProductQuery = "UPDATE products p
    INNER JOIN product_seller_junction ps ON p.id = ps.product_id
    INNER JOIN sellers s ON ps.seller_id = s.id
    SET 
        p.product_name = '$product_name',
        p.price = '$price',
        p.category = '$category',
        p.description = '$description',
        p.quantity = '$quantity',
        p.image_path = '$image_path'
        WHERE
    p.id = '$product_id'
    AND s.id = '$seller_id';
    ";

    $updateProductResult = mysqli_query($conn, $updateProductQuery);

    header("location: ../homepage/homepage.php");
