<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stores</title>
    <link rel="stylesheet" href="../admin-template.css">
    <style>
        /* Additional CSS for centering the search form */
        main {
            text-align: center;
        }

        .search-form {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .search-form input[type='text'] {
            padding: 10px;
            font-size: 18px;
        }

        .search-form input[type='submit'] {
            padding: 10px;
            font-size: 18px;
            background-color: darkgray;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form input[type='submit']:hover {
            background-color: #0056b3;
        }

        .store-info-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin-top: 20px;
        }

        .store-info {
            background-color: #fff;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px; /* Set a fixed width for each store info container */
        }

        .store-info p {
            margin: 5px 0;
        }

        .store-info form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .store-info form input[type='submit'] {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
        </div>
        <h1>View Stores</h1>
        <div class="links-container">
            <button type="button" onclick="window.location.href='../manageSellers/viewStores.php'">View Stores</button>
        </div>
    </header>

    <main>
        <form action="viewStores.php" method="POST" class="search-form">
            <input type="text" name="search" placeholder="Search Sellers">
            <input type="submit" value="Search">
        </form>

        <div class="store-info-container">
            <?php
            if (isset($_POST['search'])) {
                require '../../connect.php';

                $search = $_POST['search'];

                $viewQuery = "SELECT * FROM user_seller_view WHERE seller_store_name LIKE '%$search%'";
                $viewResult = mysqli_query($conn, $viewQuery);

                if (mysqli_num_rows($viewResult) > 0) {
                    while ($row = mysqli_fetch_assoc($viewResult)) {
                        $user_email = $row['user_email'];
                        $seller_store_name = $row['seller_store_name'];
                        $seller_id = $row['seller_id'];
            ?>
                        <div class="store-info">
                            <p>User Email: <?php echo $user_email ?></p>
                            <p>Seller Store Name: <?php echo $seller_store_name ?></p>
                            <p>Seller Seller_Id: <?php echo $seller_id?></p>
                            <form method='POST' action='deleteSellers.php'>
                                <input type='hidden' value="<?php echo $seller_id?>" name='seller_id'>
                                <input type='submit' value='Delete' name='delete'>
                            </form>
                            <form method='POST' action='../manageProducts/viewProducts.php'>
                                <input type='hidden' value="<?php echo "$seller_id" ?>" name='seller_id'>
                                <input type='submit' value='View Products' name='view'>
                            </form>
                        </div>
            <?php
                    }
                } else {
                    echo "No results found.";
                }

                mysqli_close($conn);
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SUS Marketplace</p>
    </footer>
</body>

</html>
