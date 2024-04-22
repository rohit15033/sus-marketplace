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
        require '../../connect.php';

        $user_id = $_POST['user_id'];
        $email = $_POST['email'];


        $deleteUserQuery = "DELETE FROM users WHERE id = '$user_id'";
        $deleteResult = mysqli_query($conn, $deleteUserQuery);
        header("location: searchUsers.php");
    }
?>