<?php
session_start();

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "susmarketplace";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['seller_logged_in']) && $_SESSION['seller_logged_in'] === true) {
    $seller_id = $_SESSION['seller_id'];

    $fetchorderdetailsQuery = "SELECT * FROM order_details_view WHERE seller_id = '$seller_id'";
    $fetchorderdetailsResult = mysqli_query($conn, $fetchorderdetailsQuery);
?>
    <form method="POST" action="updateOrder.php">
        <?php
        while ($orderdetailsrow = mysqli_fetch_assoc($fetchorderdetailsResult)) {
            $image_path = $orderdetailsrow['image_path'];
            $product_name = $orderdetailsrow['product_name'];
            $order_number = $orderdetailsrow['order_number'];
            $order_date = $orderdetailsrow['order_date'];
            $quantity = $orderdetailsrow['quantity'];
            $price = $orderdetailsrow['price'];
            $product_subtotal = $orderdetailsrow['product_subtotal'];
            $user_email = $orderdetailsrow['user_email'];
            $order_status = $orderdetailsrow['order_status'];
            $product_id = $orderdetailsrow['product_id'];
        ?>
            <div class='product'>
                <h2>Order number: <?php echo $order_number; ?></h2>
                <select name="order_status[]">
                    <option value="<?php echo $order_status; ?>"><?php echo $order_status; ?></option>
                    <option value="Processing">Processing</option>
                    <option value="Ready for Pickup">Ready for Pickup</option>
                </select>
                <br>
                <img src='<?php echo $image_path; ?>' alt='<?php echo $product_name; ?>' style='max-width: 200px; max-height: 200px;'>
                <h2><?php echo $product_name; ?></h2>
                <h2>Date: <?php echo $order_date; ?></h2>
                <h2><?php echo $quantity; ?></h2>
                <h2><?php echo $price; ?></h2>
                <h2><?php echo $product_subtotal; ?></h2>
                <h2><?php echo $price; ?></h2>
                <h2><?php echo $user_email; ?></h2>
                <input type="hidden" value="<?php echo $order_number; ?>" name="order_number[]">
                <input type="hidden" value="<?php echo $product_id; ?>" name="product_id[]">
                <br>
            </div>
        <?php
        }
        ?>
        <input type = "hidden" value = "<?php echo $order_number; ?>">
        <input type="submit" value="Update Status">
    </form>
<?php
}
?>