<?php
session_start();
include("config.php");

if(isset($_SESSION['user_id'])) {
    if(isset($_GET['cart_id']) && isset($_GET['item_id'])) {
        $cartId = $_GET['cart_id'];
        $itemId = $_GET['item_id'];

        // Delete the item from the cart based on cart ID and user ID
        $deleteQuery = "DELETE FROM carts WHERE id = $cartId AND user_id = {$_SESSION['user_id']} AND item_id = $itemId";
        mysqli_query($con, $deleteQuery);

        // Redirect back to the cart page
        header("Location: cart_display.php");
        exit;
    } else {
        // Redirect back to the cart page if cart_id or item_id is not provided
        header("Location: cart_display.php");
        exit;
    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}
?>
