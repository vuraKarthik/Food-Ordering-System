<?php
session_start();
include("config.php");

if(isset($_POST['place_order'])) {
    // Retrieve user ID
    $userId = $_SESSION['user_id'];

    // Retrieve phone number and address from the form
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $total_amt = mysqli_real_escape_string($con, $_POST['total_amount']);
    // Prepare an array to hold item IDs and their corresponding quantities
    $quantities = $_POST['quantities'];

    // Initialize a variable to store the total price of the order
    $totalPrice = 0;

    // Start a transaction
    mysqli_begin_transaction($con);

    try {
        // Insert order details into the orders table
        $insert_order_query = "INSERT INTO orders (user_id, phone_number, address,total_amount) VALUES ('$userId', '$phone_number', '$address','$total_amt')";
        mysqli_query($con, $insert_order_query) or die(mysqli_error($con));
        
        // Retrieve the ID of the last inserted order
        $orderId = mysqli_insert_id($con);

        // Iterate through the quantities array to insert order items into order_items table
        foreach($quantities as $itemId => $quantity) {
            // Retrieve item details
            $itemQuery = "SELECT * FROM items WHERE id = $itemId";
            $itemResult = mysqli_query($con, $itemQuery);
            $item = mysqli_fetch_assoc($itemResult);
            
            // Calculate total price for each item
            $itemTotal = $item['price'] * $quantity;

            // Insert order item into order_items table
            $insert_item_query = "INSERT INTO order_items (order_id, item_id, quantity, total_price) VALUES ('$orderId', '$itemId', '$quantity', '$itemTotal')";
            mysqli_query($con, $insert_item_query) or die(mysqli_error($con));

            // Update total price of the order
            $totalPrice += $itemTotal;

            $remove_query = "DELETE FROM carts WHERE user_id = $userId AND item_id = $itemId";
            mysqli_query($con, $remove_query) or die(mysqli_error($con));
        }

        // Commit the transaction
        mysqli_commit($con);

        // Redirect to a success page or display a success message
        header("Location: homepage.php");
        exit;
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        mysqli_rollback($con);
        echo "Error: " . $e->getMessage();
    }
}
?>
