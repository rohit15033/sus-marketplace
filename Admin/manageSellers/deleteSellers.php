<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>

<?php
    if (isset($_POST['delete']))
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

        $user_id = $_POST['user_id'];
        $email = $_POST['email'];


        $deleteUserQuery = "DELETE FROM sellers WHERE id = '$seller_id'";
        $deleteResult = mysqli_query($conn, $deleteUserQuery);
        header("location: searchUsers.php");
    }
?>