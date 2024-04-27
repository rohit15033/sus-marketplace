<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <link rel="stylesheet" href="../admin-template.css">
    <style>
        /* Additional CSS for centering the search form */
        main {
            text-align: center;
        }

        form {
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 15px;
        }

        .user-info-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin-top: 20px;
        }

        .user-info {
            background-color: #fff;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
            /* Set a fixed width for each user info container */
        }

        .user-info p {
            margin: 5px 0;
        }

        .user-info form {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
        </div>
        <h1>Search Users</h1>
        <div class="links-container">
            <button type="button" onclick="window.location.href='deleteUsers.php'">Delete Users</button>
            <button type="button" onclick="window.location.href='searchUsers.php'">Search Users</button>
        </div>
    </header>

    <main>
        <form action="searchUsers.php" method="POST">
            <input type="text" name="search" placeholder="Search Users"
                style="width: 70%; padding: 15px; font-size: 18px;">
            <input type="submit" value="Search" style="padding: 15px; font-size: 18px;">
        </form>

        <div class="user-info-container">
            <?php
            if (isset($_POST['search'])) {
                require '../../connect.php';
                $search = $_POST['search'];

                $searchQuery = "SELECT * FROM users WHERE email LIKE '%$search%' ";
                $searchResult = mysqli_query($conn, $searchQuery);

                while ($row = mysqli_fetch_assoc($searchResult)) {
                    $user_id = $row['id'];
                    $email = $row['email'];
                    ?>

                    <div class="user-info">
                        <p>Email: <?php echo $email; ?></p>
                        <p>User Id: <?php echo $user_id; ?></p>
                        <form method='POST' action='deleteUsers.php'>
                            <input type='hidden' value="<?php echo $user_id; ?>" name='user_id'>
                            <input type='submit' value='Delete' name='delete'>
                        </form>
                        <form method='POST' action='../manageSellers/viewStores.php'>
                            <input type='hidden' value="<?php echo $user_id; ?>" name='user_id'>
                            <input type='submit' value='View Stores' name='view'>
                        </form>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SUS Marketplace</p>
    </footer>
</body>

</html>