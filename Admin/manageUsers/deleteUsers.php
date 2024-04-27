<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Users</title>
    <link rel="stylesheet" href="../admin-template.css">
    <style>
        
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
            justify-content: center;
            align-items: center;
        }

        .user-info form input[type='submit'] {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="..\..\TestimonyAsset\su-logo-light.png" alt="">
        </div>
        <h1>Delete Users</h1>
        <div class="links-container">
            <button type="button" onclick="window.location.href='searchUsers.php'">Search Users</button>
        </div>
    </header>

    <main>
        <form action="deleteusers.php" method="POST" class="search-form">
            <input type="text" name="search" placeholder="Search Users">
            <input type="submit" value="Search">
        </form>

        <div class="user-info-container">
            <?php
            if (isset($_POST['delete'])) {
                require '../../connect.php';

                $user_id = $_POST['user_id'];
                $email = $_POST['email'];

                $deleteUserQuery = "DELETE FROM users WHERE id = '$user_id'";
                $deleteResult = mysqli_query($conn, $deleteUserQuery);

                header("location: searchUsers.php");
            }

            if (isset($_POST['search'])) {
                require '../../connect.php';

                $search = $_POST['search'];

                $searchQuery = "SELECT * FROM users WHERE email LIKE '%$search%'";
                $searchResult = mysqli_query($conn, $searchQuery);

                if (mysqli_num_rows($searchResult) > 0) {
                    while ($row = mysqli_fetch_assoc($searchResult)) {
                        $user_id = $row['id'];
                        $email = $row['email'];
                        ?>
                        <div class="user-info">
                            <p>Email: <?php echo $email; ?>, User Id: <?php echo $user_id; ?></p>
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
                } else {
                    echo "No users found.";
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