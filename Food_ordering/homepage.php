<?php
  session_start();
  include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    <title>Food Website</title>
    
</head>
<body>
    
    
    <!-- header -->
    
    <header>
        <a href="#" class="logo"><i class="fas fa-utensils"></i>food</a>
        
        <div id="menu-bar" class="fas fa-bars"> </div>
        
        <nav class="navbar" id="navbar">
                <a href="#home">home</a>
                <a href="#popular">menu</a>
                <a href="#gallery">gallery</a>
                <a href="#review">review</a>
                <?php if(isset($_SESSION['valid'])) { ?>
                      <a href="cart_display.php">MyCart</a>
                      <a href="placed_orders.php">MyOrders</a>
                      <a href="logout.php">Logout</a>
                <?php } else { ?>
                <a href="login.php">Login</a>
                <?php } ?>
         </nav>
    </header>
    
    <!-- header end -->
    
    
    <!-- home start -->
    
    <section class="home" id="home">
        <div class="content">
            <h3> food made with love   </h3>
            <p>
            Explore our diverse selection of mouthwatering dishes, each crafted to satisfy your cravings. From savory delights to delectable desserts, our menu offers an array of flavors to tantalize your taste buds. Taste the perfection in every dish, carefully prepared with attention to detail. Elevate your dining experience with our exceptional variety, where every ingredient tells a story of passion. Welcome to a culinary journey where every meal is a celebration of flavor!
            </p>
            <a href="#popular" class="btn">order now</a>
        </div>
        
        <div class="image">
            <img src="images/home-img.png" alt="img">
        </div>
        
    </section>
    <!-- home section end -->
    

    <!-- speciality section start -->
    
    <section class="speciality" id="speciality">
        
        <h1 class="heading"><span>Chef's speciality</span>  </h1>
        
        <div class="box-container">
            
            <div class="box">
                
                <img class="image" src="images/s-img-1.jpg" alt="">
                
                <div class="content">
                    <img src="images/s-1.png" alt="">
                    <h3>tasty burger</h3>
                    <p>Juicy beef patty, crisp veggies, and melted cheese in a soft bun—a classic delight that satisfies every craving.</p>
                </div>
            </div> 
            
            <div class="box">
                
                <img class="image" src="images/s-img-2.jpg" alt="">
                
                <div class="content">
                    <img src="images/s-2.png" alt="">
                    <h3>tasty pizza</h3>
                    <p>Thin crust topped with gooey cheese and your favorite toppings, baked to perfection for a taste of Italy in every slice.</p>
                </div>
                
            </div> 
            <div class="box">
                
                <img class="image" src="images/s-img-3.jpg" alt="">
                
                <div class="content">
                    <img src="images/s-3.png" alt="">
                    <h3>cold ice-cream</h3>
                    <p>Creamy scoops of indulgence in a variety of flavors, perfect for cooling off on a hot day or treating yourself anytime.</p>
                </div>
            </div> 
            <div class="box">
                
                <img class="image" src="images/s-img-4.jpg" alt="">
                
                <div class="content">
                    <img src="images/s-4.png" alt="">
                    <h3>cold drinks</h3>
                    <p>Refreshing beverages served icy cold, from fizzy sodas to fruity concoctions, quenching your thirst with every sip.</p>
                </div>
            </div> 
            
            <div class="box">
                
                <img class="image" src="images/s-img-5.jpg" alt="">
                
                <div class="content">
                    <img src="images/s-6.png" alt="">
                    <h3>Breakfast</h3>
                    <p>Start your day right with a hearty meal of eggs, bacon, and toast, fueling you up for whatever lies ahead.</p>
                </div>
            </div> 
            
            <div class="box">
                
                <img class="image" src="images/s-img-6.jpg" alt="">
                
                <div class="content">
                    <img src="images/s-5.png" alt="">
                    <h3>Dinner</h3>
                    <p>Savor a delicious feast of flavors, from succulent meats to savory sides, making every evening meal a special occasion.</p>
                </div>
            </div> 
        </div>  
    </section>
    
    
    <!-- speciality section end -->


    <!-- popular section started  -->
    <section class="popular" id="popular">
        
        <h1 class="heading"><span>Most popular</span></h1>
        <div class="box-container">
            <div class="box">
                <span class="price">80Rs. - 200Rs.</span>
                <img src="images/p-1.jpg" alt="">
                <h3>tasty burger</h3>
                <div class="star">
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                </div>
              <?php if(isset($_SESSION['user_id'])) { ?>
              <a href="add_to_cart.php?item_id=1<?php echo $menuItemID; ?>" class="btn">Add to Cart</a>
              <?php } ?>
               
            </div>
            
            <div class="box">
                <span class="price">300Rs. - 1000Rs.</span>
                <img src="images/p-2.jpg" alt="">
                <h3>tasty cakes</h3>
                <div class="star">
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                </div>
              <?php if(isset($_SESSION['user_id'])) { ?>
              <a href="add_to_cart.php?item_id=2<?php echo $menuItemID; ?>" class="btn">Add to Cart</a>
              <?php } ?>
              <?php if(isset($_SESSION['cart_success'])) { ?>
            <div class="success-message"><?php echo $_SESSION['cart_success']; ?></div>
            <?php unset($_SESSION['cart_success']); ?>
        <?php } ?>
                
            </div>
            
            <div class="box">
                <span class="price">150Rs. - 600Rs.</span>
                <img src="images/p-3.jpg" alt="">
                <h3>tasty sweets</h3>
                <div class="star">
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                </div>
                <?php if(isset($_SESSION['user_id'])) { ?>
              <a href="add_to_cart.php?item_id=3<?php echo $menuItemID; ?>" class="btn">Add to Cart</a>
              <?php } ?> 
                
            </div>
            
            <div class="box">
                <span class="price">100Rs. - 500Rs.</span>
                <img src="images/p-4.jpg" alt="">
                <h3>tasty cup-cakes</h3>
                <div class="star">
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                </div>
                <?php if(isset($_SESSION['user_id'])) { ?>
              <a href="add_to_cart.php?item_id=4<?php echo $menuItemID; ?>" class="btn">Add to Cart</a>
              <?php } ?>
                
            </div>
            
            <div class="box">
                <span class="price">50Rs.</span>
                <img src="images/p-5.jpg" alt="">
                <h3>cold drinks</h3>
                <div class="star">
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                </div>
              <?php if(isset($_SESSION['user_id'])) { ?>
              <a href="add_to_cart.php?item_id=5<?php echo $menuItemID; ?>" class="btn">Add to Cart</a>
              <?php } ?> 
                
            </div>
            
            <div class="box">
                <span class="price">100Rs.</span>
                <img src="images/p-6.jpg" alt="">
                <h3>cold ice-cream</h3>
                <div class="star">
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                </div>
                <?php if(isset($_SESSION['user_id'])) { ?>
              <a href="add_to_cart.php?item_id=6<?php echo $menuItemID; ?>" class="btn">Add to Cart</a>
              <?php } ?>
             </div>
        </div>
        
    </section>
    
    <!-- popular section end -->
    
    
    <!-- steps section starts -->
    
    <section class="steps">
        
        <div class="box">
            <img src="images/step-1.jpg" alt="">
            <h3>Choose your favorite food</h3>
        </div>
        <div class="box">
            <img src="images/step-2.jpg" alt="">
            <h3>Free and Fast delivery</h3>
        </div>
        <div class="box">
            <img src="images/step-3.jpg" alt="">
            <h3>Easy payments method</h3>
        </div>
        <div class="box">
            <img src="images/step-4.jpg" alt="">
            <h3>Enjoy your food</h3>
        </div>
        
    </section>
    
    
    <!-- steps section ends -->
    
    
    <!-- gallery section start -->
    <section class="gallery" id="gallery">
        
        <h1 class="heading"> our food <span>gallery</span></h1>
        
        <div class="box-container">
            
            <div class="box">
                <img src="images/g-1.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="box">
                <img src="images/g-2.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div><div class="box">
                <img src="images/g-4.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="box">
                <img src="images/g-3.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div><div class="box">
                <img src="images/g-5.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="box">
                <img src="images/g-6.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="box">
                <img src="images/g-7.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="box">
                <img src="images/g-8.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
            <div class="box">
                <img src="images/g-9.jpg" alt="">
                <div class="content">
                    <h3>tasty food</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, saepe!</p>
                    <a href="#" class="btn">order now</a>
                </div>
            </div>
        </div>
        
    </section>
    
    <!-- gallery sectin ends -->
    
    <!-- review section start -->
    
    <section class="review" id="review">
        
        <h1 class="heading"> our customers <span>reviews</span></h1>
        
        <div class="box-container">
            
            <div class="box">
                <img src="images/pic1.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Absolutely blown away by the quality of food and service! From the moment we stepped in, we were greeted warmly, and the food surpassed all expectations. Every dish was bursting with flavor, and the presentation was top-notch. Definitely coming back for more!</p>
            </div>
            <div class="box">
                <img src="images/pic2.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Had a wonderful time with delicious food!</p>
            </div>
            <div class="box">
                <img src="images/pic3.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Impressive experience from start to finish! The ambiance was inviting, and the staff were attentive and friendly. The menu offered a wide variety of options, and each dish we tried was deliciously satisfying. A great place to dine with friends or family!</p>
            </div>
            
        </div>
        
    </section>
    
    <!-- review section ends -->
    

    <!-- footer section start -->
   <section class="footer">

     <div class="share">
         <a href="https://www.facebook.com" class="btn">facebook</a>
         <a href="https://twitter.com" class="btn">twitter</a>
         <a href="https://www.instagram.com" class="btn">instagram</a>
     </div>

   </section>

    <!-- footer section ends -->
    
    <!-- scroll section sterts -->
   
    <!-- scroll top btn -->
    
    <a href="#home" class="fas fa-angle-up" id="scroll-top"></a>


    <!-- scroll section ends -->

    <!-- loder -->

   <div class="loader-container">
        <img src="images/loader.gif" alt="">
    </div>
    

               


    <!-- js file link -->
    <script src="script.js"></script>
</body>
</html>