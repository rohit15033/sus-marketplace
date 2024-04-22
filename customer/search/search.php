<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css">
</head>

<body>
    <div class='container'>

        <div class="header">
            <div class="logo-container">
                <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
            </div>
        </div>
        <div class="header-accent"></div>


        <aside class="sidebar-container">
            <nav class="sidebar">
                <div><a href="../register/register.html" class="button">- Register</a></div>
                <div><a href="../login/login.php" class="button">- Login</a></div>
                <div><a href="../logout/logout.php" class="button">- Logout</a></div>
                <div><a href="../../seller/register/register.php" class="button">- Start Selling</a></div>
            </nav>
        </aside>


        <div class="search-product-container">
            <form method="POST" action="search.php">
                <input type="text" name="search" placeholder="Search here..">
            </form>
            <div class='product-container'>
            <?php
session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    if (isset($_POST['search'])) {

        $email = $_SESSION['email'];
        require '../../connect.php';

        $search = $_POST['search'];
        $searchQuery = "SELECT * FROM product_seller_view WHERE product_name LIKE '%$search%' OR category LIKE '%$search%'";
        $searchResult = mysqli_query($conn, $searchQuery);

        if(mysqli_num_rows($searchResult) === 0) {
            echo "<p>Sorry, we don't have that yet. Try searching for something else.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($searchResult)) {
                $product_name = $row['product_name'];
                $image_path = $row['image_path'];
                $quantity = $row['quantity'];
                $description = $row['description'];
                $category = $row['category'];
                $price = $row['price'];
                $product_id = $row['product_id'];
                $seller_id = $row['seller_id'];

                echo "<div class='product'>
                    <a href='../product/product.php?product_id=$product_id'>
                        <img src='$image_path' alt='$product_name'>
                        <div class='product-info-container'>
                            <h2 class='product-name'>$product_name</h2>
                            <h2 class='price'>$price</h2>
                            <h2 class='quantity'>$quantity</h2>
                            <h2>$category</h2>
                        </div>
                    </a>
                </div>";
            }
        }

        mysqli_close($conn);
    } else {
        header("Location: search.php");
        exit();
    }
} else {
    header("Location: ../login/login.php");
    exit();
}
?>

            </div>
        </div>
    </div>
</body>

</html>