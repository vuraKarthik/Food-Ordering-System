<?php
session_start();
include("config.php");

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    
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
    <title>My Cart</title>
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

        .cart-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
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

        .checkout-btn {
            padding: 10px 20px;
            background-color: #ff5f6d;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #ff3d4a;
        }

        .empty-cart-msg {
            text-align: center;
            color: #888;
            margin-top: 20px;
        }

        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader-container img {
            width: 50px;
            height: 50px;
        }

        .fade-out {
            animation: fadeOut 1s forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
</head>
<body>

<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i>food</a>
    
    <nav class="navbar" id="navbar">
        <a href="homepage.php#home">home</a>
        <a href="homepage.php#popular">menu</a>
        <?php if(isset($_SESSION['valid']) && $_SESSION['valid']) { ?>
            <a href="cart_display.php">MyCart</a>
            <a href="placed_orders.php">MyOders</a>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
        <?php } ?>
    </nav>
</header>

<section class="container">
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
            <div class="cart-items">
                <?php
                $totalPrice=0;
                while($row = mysqli_fetch_assoc($result)) {
                    $itemName = $row['name'];
                    $itemPrice = $row['price'];
                    $itemQuantity = $row['quantity'];
                    $itemTotal = $itemPrice * $itemQuantity;
                    ?>
                    <div class="cart-item">
                        <img src="item_images/<?php echo $row['item_id']; ?>.jpg" alt="<?php echo $itemName; ?>">
                        <div class="cart-item-details">
                            <h2><?php echo $itemName; ?></h2>
                            <p>Price: $<?php echo number_format($itemPrice, 2); ?></p>
                            <p>Quantity: <?php echo $itemQuantity; ?></p>
                            <p class="cart-item-price">Total: $<?php echo number_format($itemTotal, 2); ?></p>
                        </div>
                        <div class="cart-item-remove"><i class="fas fa-times"></i></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="cart-footer">
                <div class="cart-total">Total: $<?php echo number_format($totalPrice, 2); ?></div>
                <button type="button" class="checkout-btn">Place Order</button>
            </div>
            <?php
        } else {
            ?>
            <div class="empty-cart-msg">Your cart is empty</div>
            <?php
        }
        ?>
    </div>
</section>

<script>
    // Function to remove item from cart
    function removeItem(cartId, itemId) {
        // You can implement AJAX here to remove the item from the cart without refreshing the page
        console.log("Removing item from cart with cartId: " + cartId + " and itemId: " + itemId);
    }

    // Function to handle checkout button click
    function handleCheckout(totalPrice) {
        // You can redirect to the checkout page or perform any other action here
        console.log("Proceeding to checkout. Total price: " + totalPrice);
    }

    // Add event listeners after the DOM content is loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Add event listeners to all remove buttons
        const removeButtons = document.querySelectorAll(".cart-item-remove");
        removeButtons.forEach(button => {
            button.addEventListener("click", function() {
                const cartId = button.dataset.cartId;
                const itemId = button.dataset.itemId;
                removeItem(cartId, itemId);
            });
        });

        // Remove fade-out class from loader container
        document.querySelector('.loader-container').classList.remove('fade-out');

        // Add event listener to checkout button
        const checkoutButton = document.querySelector(".checkout-btn");
        checkoutButton.addEventListener("click", function() {
            const totalPrice = document.querySelector(".cart-total").textContent.replace("Total: $", "");
            handleCheckout(parseFloat(totalPrice));
        });
    });
</script>

</body>
</html>
