<?php
session_start();
include("config.php");


if(isset($_SESSION['user_id']) && isset($_GET['item_id']) && !empty($_GET['item_id'])) {
    $userId = $_SESSION['user_id'];
    $itemId = $_GET['item_id'];

    
    $query = "SELECT * FROM carts WHERE user_id = $userId AND item_id = $itemId";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0) {
      
        $row = mysqli_fetch_assoc($result);
        $newQuantity = $row['quantity'] + 1;
        $updateQuery = "UPDATE carts SET quantity = $newQuantity WHERE user_id = $userId AND item_id = $itemId";
        mysqli_query($con, $updateQuery);
    } else {
       
        $insertQuery = "INSERT INTO carts (user_id, item_id, quantity) VALUES ($userId, $itemId, 1)";
        mysqli_query($con, $insertQuery);
    }
}



header("Location: homepage.php#popular");


?>
