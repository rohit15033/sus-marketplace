<?php
if (isset($_POST['search'])) {
    require '../../connect.php';

    $search = $_POST['search'];


    $searchQuery = "SELECT * FROM user_seller_view WHERE seller_store_name LIKE '%$search%' ";
    $searchResult = mysqli_query($conn, $searchQuery);

    while ($row = mysqli_fetch_assoc($searchResult)) {
        $seller_id = $row['seller_id'];
        $seller_store_name = $row['seller_store_name'];
        $user_email = $row['user_email'];
        
?>

        User Email: <?php echo $user_email ?>, Seller Store Name: <?php echo $seller_store_name ?>, Seller Seller_Id: <?php echo $seller_id ?> <br>
        <form method='POST' action='deleteSellers.php'>
            <input type='hidden' value="<?php echo "$seller_id" ?>" name='seller_id'>
            <input type='submit' value='delete' name='delete'>
        </form>
        <form method='POST' action='../manageProducts/viewProducts.php'>
            <input type='hidden' value="<?php echo "$seller_id" ?>" name='seller_id'>
            <input type='submit' value='View Products' name='view'>
        </form>

<?php
    }
}
?>