<?php
session_start();
include("config.php");

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    // Retrieve cart items from database based on user ID
    $query = "SELECT carts.id as cart_id, items.id as item_id, items.name, items.price, carts.quantity FROM carts JOIN items ON carts.item_id = items.id WHERE user_id = $userId";
    $result = mysqli_query($con, $query);
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
    <title>Your Cart</title>
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .cart {
            margin-top: 100px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .cart-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .cart-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .cart-item {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
        }
        .cart-item-details {
            margin-top: 10px;
        }

        .cart-item-details h2 {
            font-size: 18px;
            margin: 0;
        }

        .cart-item-details p {
            margin: 5px 0;
            color: #888;
        }

        .cart-item-price {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .cart-item-remove {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #888;
        }

        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .cart-total {
            font-size: 18px;
            font-weight: bold;
        }
        .form-group {
        margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }

        .form-group textarea {
            height: 100px; 
        }

        .empty-cart-msg {
            text-align: center;
            color: #888;
            margin-top: 20px;
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

    <section class="conatiner">
    <div class="cart">
        <div class="cart-header">
            <h1>My Cart</h1>
            <div class="loader-container">
                <img src="images/loader.gif" alt="">
            </div>
        </div>
        <?php
        if(mysqli_num_rows($result) > 0) {
            ?>
            <form action="place_order.php" method="post">
                 <div class="cart-items">
                    <?php
                   $totalPrice = 0;
                    while($row = mysqli_fetch_assoc($result)) {
                        $itemName = $row['name'];
                        $itemPrice = $row['price'];
                        $itemQuantity = $row['quantity'];
                        $itemTotal = $itemPrice * $itemQuantity;
                        $totalPrice += $itemTotal;
                        ?>
                        <div class="cart-item">
                            <div class="cart-item-details">
                            <h2><?php echo $itemName; ?></h2>
                            <p>Price: Rs. <?php echo number_format($itemPrice, 2); ?></p>
                            <p>Quantity: <?php echo $itemQuantity; ?></p>
                            <input type="hidden" name="quantities[<?php echo $row['item_id']; ?>]" value="<?php echo $itemQuantity; ?>" min="1">
                            <p class="cart-item-price">Total: Rs. <?php echo number_format($itemTotal, 2); ?></p>

                            </div>
                            <div class="cart-item-remove">
                            <a href="remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>&item_id=<?php echo $row['item_id']; ?>"><i class="fas fa-times"></i></a>
                            </div>

                        </div>
                        <?php
                    }
                    ?>

                 </div>
                 <div class="cart-footer">
                    <div class="cart-total">Total: Rs. <?php echo number_format($totalPrice, 2); ?>
                      <input type="hidden" name="total_amount" value="<?php echo $totalPrice; ?>">
                    </div>
                 </div>
                <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
                </div>
                <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
                </div>
                <button type="submit" name="place_order" class="btn">Place Order</button>
            </form>
            <?php
        } else {
            ?>
            <div class="empty-cart-msg">Your cart is empty</div>
            <?php
        }
        ?>
    </section>
 

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