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


        $searchQuery = "SELECT * FROM products WHERE product_name LIKE '%$search%' ";
        $searchResult = mysqli_query($conn, $searchQuery);

        while ($row = mysqli_fetch_assoc($searchResult))
        {
            $user_id = $row['id'];
            $email = $row['store_name'];
            ?>

            Email: <?php echo "$email"?>, Id: <?php echo "$user_id" ?> 
            <form method = 'POST' action = 'deleteSellers.php'>
                <input type = 'hidden' value="<?php echo "$user_id"?>" name = 'user_id'>
                <input type = 'submit' value = 'delete' name = 'delete'>
            </form>
            <form method = 'POST' action = '../manageSellers/viewStores.php'>
                <input type = 'hidden' value="<?php echo "$user_id"?>" name = 'user_id'>
                <input type = 'submit' value = 'View Products' name = 'view'>
            </form>

            <?php
        }
    }
?>