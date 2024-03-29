<?php 
    if(isset($_POST["signup"]))
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

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        if ($password == $confirm_password)
        {
            $insert_user_data_query = "INSERT INTO users (email, password) VALUES ('$email', '$password');";
            $insert_user_data = mysqli_query($conn, $insert_user_data_query);
        }

        $select_all_query = "SELECT * FROM users";
        $select_all = mysqli_query($conn, $select_all_query);

        echo "<table border cellpadding = 1>";
        echo "<tr><th>Email</th><th>Password</th></tr>";
        while($row = mysqli_fetch_array($select_all))
        {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "</tr>";
        }

        $conn->close();
    }
?>