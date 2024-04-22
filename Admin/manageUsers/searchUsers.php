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
        require '../../connect.php';
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