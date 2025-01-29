<?php
session_start();
include("config.php");

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    // Retrieve orders from the database based on user ID
    $orderQuery = "SELECT * FROM orders WHERE user_id = $userId";
    $orderResult = mysqli_query($con, $orderQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="navbarstyle.css">
    <title>Your Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background:url(images/home-bg.jpg) no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .orders-header{
            margin-top: 100px;
            padding: 20px;
        }
        .orders-header h1 {
            font-size: 30px;
            margin: 0;
        }
        .orders {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
        }
        .order {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .order h2 {
            font-size: 18px;
            margin-top: 0;
        }
        .order-details {
            margin-top: 10px;
        }
        .order-details p {
            margin: 5px 0;
            font-size: 14px;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<header>
        <a href="#" class="logo"><i class="fas fa-utensils"></i>food</a>
        
        <nav class="navbar" id="navbar">
                <a href="homepage.php#home">home</a>
                <a href="homepage.php#popular">menu</a>
                <?php if(isset($_SESSION['valid'])) { ?>
                      <a href="cart_display.php">MyCart</a>
                      <a href="placed_orders.php">MyOrders</a>
                      <a href="logout.php">Logout</a>
                <?php } else { ?>
                <a href="login.php">Login</a>
                <?php } ?>
         </nav>
    </header>

    <div class="orders-header"><h1>My Orders</h1></div>
    <div class="loader-container">
                <img src="images/loader.gif" alt="">
    </div>

    <section class="orders">
        <?php
        if(mysqli_num_rows($orderResult) > 0) {
            while($orderRow = mysqli_fetch_assoc($orderResult)) {
                $orderId = $orderRow['order_id'];
                $total_amt= $orderRow['total_amount'];
                $orderDate = $orderRow['order_date'];
                ?>
                <div class="order">
                    <h2>Order ID: <?php echo $orderId; ?></h2>
                    <div class="order-details">
                        <p><strong>Order Date:</strong> <?php echo $orderDate; ?></p>
                        <p><strong>Total Amount:</strong> <?php echo $total_amt; ?></p>
                        <p><strong>Order Items:</strong></p>
                        <?php
                    
                        $itemsQuery = "SELECT items.name, order_items.quantity FROM order_items JOIN items ON order_items.item_id = items.id WHERE order_items.order_id = $orderId";
                        $itemsResult = mysqli_query($con, $itemsQuery);
                        if(mysqli_num_rows($itemsResult) > 0) {
                            while($itemRow = mysqli_fetch_assoc($itemsResult)) {
                                echo "<p>" . $itemRow['name'] . " (Quantity: " . $itemRow['quantity'] . ")</p>";
                            }
                        } else {
                            echo "<p>No items in this order</p>";
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No orders yet</p>";
        }
        ?>
    </section>

    <footer>
        <!-- Footer content -->
    </footer>

    <script>
     function loader(){
        document.querySelector('.loader-container').classList.add('fade-out');
        }

        function fadeOut(){
        setInterval(loader, 1500);
        }
        window.onload = fadeOut();
    </script>

</body>
</html>
