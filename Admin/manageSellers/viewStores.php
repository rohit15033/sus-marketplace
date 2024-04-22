<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="searchSellers.php" method="POST">
        <input type='text' name='search' placeholder="Search Sellers">
    </form>
</body>

</html>

<?php

if (isset($_POST['view'])) {
    require '../../connect.php';
    $user_id = $_POST['user_id'];

    $viewQuery = "SELECT * FROM user_seller_view WHERE user_id = '$user_id'";
    $viewResult = mysqli_query($conn, $viewQuery);

    if (mysqli_num_rows($viewResult) > 0) {
        while ($row = mysqli_fetch_assoc($viewResult)) {
            $user_email = $row['user_email'];
            $seller_store_name = $row['seller_store_name'];
            $seller_id = $row['seller_id'];
?>
            User Email: <?php echo $user_email ?>, Seller Store Name: <?php echo $seller_store_name ?>, Seller Seller_Id: <?php echo $seller_id?> <br>
            <form method = 'POST' action = 'deleteSellers.php'>
                <input type = 'hidden' value="<?php echo $seller_id?>" name = 'seller_id'>
                <input type = 'submit' value = 'delete' name = 'delete'>
            </form>
            <form method = 'POST' action = '../manageProducts/viewProducts.php'>
            <input type='hidden' value="<?php echo "$seller_id" ?>" name='seller_id'>
                <input type = 'submit' value = 'View Products' name = 'view'>
            </form>

<?php
        }
    } else {
        echo "No results found.";
    }

    mysqli_close($conn);
}
?>