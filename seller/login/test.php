<?php
session_start();
require '../../connect.php';

$session_user_id = $_SESSION['user_id'];
$junctionQuery = "SELECT * FROM user_seller_junction WHERE user_id = '$session_user_id'";
$junctionResult = mysqli_query($conn, $junctionQuery);

if (mysqli_num_rows($junctionResult) > 0) {
    while ($junctionRow = mysqli_fetch_assoc($junctionResult)) {
        $seller_id = $junctionRow['seller_id'];
        echo "userID: $session_user_id, sellerID: $seller_id<br>";
    }
} else {
    echo "No seller ID found for user ID: $session_user_id";
}

mysqli_free_result($junctionResult);
mysqli_close($conn);
?>
