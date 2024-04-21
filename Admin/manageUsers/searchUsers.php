<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="searchUsers.php" method ="POST">
        <input type = 'text' name = 'search' placeholder="Search Users">
    </form>
</body>
</html>

<?php
    if (isset($_POST['search']))
    {
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn -> connect_error)
        {
            die("Connection failed: ". $conn -> connect_error);
        }

        $search = $_POST['search'];


        $searchQuery = "SELECT * FROM users WHERE email LIKE '%$search%' ";
        $searchResult = mysqli_query($conn, $searchQuery);

        while ($row = mysqli_fetch_assoc($searchResult))
        {
            $user_id = $row['id'];
            $email = $row['email'];
            ?>

            Email: <?php echo "$email"?>, User Id: <?php echo "$user_id" ?> 
            <form method = 'POST' action = 'deleteUsers.php'>
                <input type = 'hidden' value="<?php echo "$user_id"?>" name = 'user_id'>
                <input type = 'submit' value = 'delete' name = 'delete'>
            </form>
            <form method = 'POST' action = '../manageSellers/viewStores.php'>
                <input type = 'hidden' value="<?php echo "$user_id"?>" name = 'user_id'>
                <input type = 'submit' value = 'View Stores' name = 'view'>
            </form>

            <?php
        }
    }
?>