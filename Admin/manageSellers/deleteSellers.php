<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Sellers</title>
    <link rel="stylesheet" href="../admin-template.css">
    <style>
        /* Additional CSS for centering the search form */
        main {
            text-align: center;
        }

        .delete-form {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .delete-form input[type='text'] {
            padding: 10px;
            font-size: 18px;
        }

        .delete-form input[type='submit'] {
            padding: 10px;
            font-size: 18px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-form input[type='submit']:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
        </div>
        <h1>Delete Sellers</h1>
        <div class="links-container">
            <button type="button" onclick="window.location.href='../manageSellers/viewStores.php'">View Stores</button>
        </div>
    </header>

    <main>
        <form action="deletesellers.php" method="POST" class="delete-form">
            <input type="text" name="search" placeholder="Enter Seller ID to Delete">
            <input type="submit" value="Delete">
        </form>

        <?php
        if (isset($_POST['delete'])) {
            require '../../connect.php';

            $seller_id = $_POST['seller_id'];

            $deleteSellerQuery1 = "DELETE FROM sellers WHERE id = '$seller_id'";
            $deleteResult1 = mysqli_query($conn, $deleteSellerQuery1);
            $deleteSellerQuery2 = "DELETE FROM user_seller_junction WHERE seller_id = '$seller_id'";
            $deleteResult2 = mysqli_query($conn, $deleteSellerQuery2);

            if ($deleteResult1 && $deleteResult2) {
                echo "Seller deleted successfully.";
            } else {
                echo "Error deleting seller.";
            }

            mysqli_close($conn);
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 SUS Marketplace</p>
    </footer>
</body>

</html>
