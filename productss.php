<?php

// Start or resume the session
session_start();

include("Configuration.php");

// Check if the form is submitted and process the cart data
if (isset($_POST['add-to-cart'])) {
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];

   // Create or update a session variable to store the cart data
   if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
   }

   // Add the product to the cart
   $_SESSION['cart'][] = [
      'name' => $product_name,
      'price' => $product_price,
   ];

   $_SESSION['count'] = isset($_SESSION['count']) ? $_SESSION['count'] + 1 : 1;

   // Redirect back to products.php
   header('Location: products.php');
   exit();

   if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
      // The 'cart' key exists in the session and is not empty
      $cart = $_SESSION['cart'];
   } else {
      // Handle the case where 'cart' doesn't exist or is empty
      $cart = [];
   }

   // Redirect back to products.php
   header('Location: products.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="./assets/css/style.css">
   <link rel="stylesheet" href="./assets/css/style3.css">
   <link rel="stylesheet" href="./assets/css/addtocart.css">

   <style>
      /* Initially hide container2 */
      .container2 {
         display: none;
      }
   </style>

</head>

<body>

   <!------------------------------------------------------------------- Header Section --------------------------------------------------------------------------------->
   <div class="container2">
      <div id="root"></div>
      <div class="sidebar">
         <div class="head">
            <h4>My Cart</h4>
         </div>
         <div id="cart-list">Your cart is empty</div>
         <div class="foot">
            <h2 id="cart-total">R 0.00</h2>
            <a href="checkout.php" class="btn proceed-to-checkout-btn">Proceed to Checkout</a>
         </div>
      </div>
   </div>
   </div>
   </div>

   <header class="header">
      <div class="flex">

         <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/logo.png" width=120px alt="">
         <h1> MAMAS BOYS KOTA AND CHIPS</h1>

         <div class="new">
            <a href="home.php">Home</a>
            <a href="products.php"><mark>Shop</mark></a>
            <a href="about.php">About</a>
            <a href="Contact.php">Contact</a>
            <a href="account.html">Account</a>
         </div>

         <div class="icons">
            <a href="search_page.html" class="fas fa-search"></a>
            <a href="Login.php"> <id="user-btn" class="fas fa-user"></id>

                  <a href="#" id="add-to-cart-icon" class="fas fa-shopping-cart"><span id="count">0</span></a>

         </div>

         <div class="profile">

            <a href="user_profile_update.html" class="btn">update profile</a>
            <a href="Logout.php" class="delete-btn">logout</a>
            <div class="flex-btn">
               <a href="Login.php" class="option-btn">login</a>
               <a href="Register.php" class="option-btn">register</a>
            </div>
         </div>
      </div>
   </header>
   <!----------------------------------------------------------- Add To Cart------------------------------------------------------------------------>



   <section class="home-category">

      <h1 class="title">KOTA</h1>
      <div class="box-container">

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota vienna 2.jpg" alt="">
            <h2>Toyota</h2>
            <p>Bread, Atchar, Polony, Chips & Vienna</p>
            <h3>R22</h3>
            <button class="btn add-to-cart-btn" data-name="Toyota" data-price="22">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota cheese.png" alt="">
            <h2>VW</h2>
            <p>Bread, Atchar, Polony, Chips & Cheese</p>
            <h3>R23</h3>
            <button class="btn add-to-cart-btn" data-name="VW" data-price="23">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota palony 2.jpg" alt="">
            <h2>Lexus</h2>
            <p>Bread, Atchar, Polony, Chips & Eggs</p>
            <h3>R27</h3>
            <button class="btn add-to-cart-btn" data-name="Lexus" data-price="27">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota russian.jpg" alt="">
            <h2>BMW</h2>
            <p>Bread, Atchar, Polony, Chips & Russian</p>
            <h3>R30</h3>
            <button class="btn add-to-cart-btn" data-name="BMW" data-price="30">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota russian 2.jpg" alt="">
            <h2>Mercedez</h2>
            <p>Bread, Atchar, Polony, Chips, Russian & Vienna</p>
            <h3>R35</h3>
            <button class="btn add-to-cart-btn" data-name="Mercedez" data-price="35">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota vienna 3.jpg" alt="">
            <h2>Audi</h2>
            <p>Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese</p>
            <h3>R40</h3>
            <button class="btn add-to-cart-btn" data-name="Audi" data-price="40">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota 41.jpg" alt="">
            <h2>Tiguan</h2>
            <p>Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese & Burger</p>
            <h3>R50</h3>
            <button class="btn add-to-cart-btn" data-name="Tiguan" data-price="50">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota ev.jpg" alt="">
            <h2>Jeep</h2>
            <p>Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger & Egg</p>
            <h3>R60</h3>
            <button class="btn add-to-cart-btn" data-name="Jeep" data-price="60">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota 41.jpg" alt="">
            <h2>Ferrari</h2>
            <p>Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg & Fish Finger</p>
            <h3>R70</h3>
            <button class="btn add-to-cart-btn" data-name="Ferrari" data-price="70">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/kota bacon 2.jpg" alt="">
            <h2>Lamborghini</h2>
            <p>Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg, Fish Finger & Bacon</p>
            <h3>R80</h3>
            <button class="btn add-to-cart-btn" data-name="Lamborghini" data-price="80">ADD TO CART</button>
         </div>
      </div>
      <br><br><br><br>

      <!-------------------------------------------------------------------- CHIPS CATEGORY -------------------------------------------------------------------------------- -->

      <h1 class="title">Chips</h1>
      <div class="box-container">
         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/small chips.jpg" alt="">
            <h2>Small</h2>
            <h3>R40</h3>
            <button class="btn add-to-cart-btn" data-name="Small Chips" data-price="40">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/small chips 2.webp" alt="">
            <h2>Medium</h2>
            <h3>R55</h3>
            <button class="btn add-to-cart-btn" data-name="Medium Chips" data-price="55">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/small chips 3.jpeg" alt="">
            <h2>Large</h2>
            <h3>R70</h3>
            <button class="btn add-to-cart-btn" data-name="Large" data-price="70">ADD TO CART</button>
         </div>
      </div>

      <br><br><br><br>

      <!-------------------------------------------------------------------- EXTRAS CATEGORY -------------------------------------------------------------------------------- -->

      <h1 class="title">Extras</h1>
      <div class="box-container">

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/eggs.jpg" alt="">
            <h2>Egg</h2>
            <h3>R12</h3>
            <button class="btn add-to-cart-btn" data-name="Egg" data-price="12">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/Russian2.jpg" alt="">
            <h2>Russian</h2>
            <h3>R15</h3>
            <button class="btn add-to-cart-btn" data-name="Russian" data-price="15">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/Vienna 2.jpg" alt="">
            <h2>Vienna</h2>
            <h3>R10</h3>
            <button class="btn add-to-cart-btn" data-name="Vienna" data-price="10">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/cheese.png" alt="">
            <h2>Cheese</h2>
            <h3>R10</h3>
            <button class="btn add-to-cart-btn" data-name="Cheese" data-price="10">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/Burger.webp" alt="">
            <h2>Burger</h2>
            <h3>R15</h3>
            <button class="btn add-to-cart-btn" data-name="Burger" data-price="15">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/fish finger.jpg" alt="">
            <h2>Fish Finger</h2>
            <h3>R12</h3>
            <button class="btn add-to-cart-btn" data-name="Fish Finger" data-price="12">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/bacon.jpeg" alt="">
            <h2>Bacon</h2>
            <h3>R13</h3>
            <button class="btn add-to-cart-btn" data-name="Bacon" data-price="13">ADD TO CART</button>
         </div>

         <div class="box">
            <img src="C:\Users\gladb\OneDrive\Documents\Website pictures/Polony.jpg" alt="">
            <h2>Polony</h2>
            <h3>R5</h3>
            <button class="btn add-to-cart-btn" data-name="Polony" data-price="5">ADD TO CART</button>
         </div>
      </div>
      <br><br>
   </section>

   <!-------------------------------------------------------------------- Footer Section ---------------------------------------------------------------------------------->
   <footer class="footer">
      <section class="box-container">
         <div class="box">
            <h3>quick links</h3>
            <a href="home.html"> <i class="fas fa-angle-right"></i> Home</a>
            <a href="products.html"> <i class="fas fa-angle-right"></i> Shop</a>
            <a href="about.html"> <i class="fas fa-angle-right"></i> About</a>
            <a href="contact.html"> <i class="fas fa-angle-right"></i> Contact</a>
         </div>

         <div class="box">
            <h3>Account Info</h3>
            <a href="cart.html"> <i class="fas fa-angle-right"></i> Cart</a>
            <a href="login.html"> <i class="fas fa-angle-right"></i> Login</a>
            <a href="signup.html"> <i class="fas fa-angle-right"></i> Register</a>
            <a href="account.html"> <i class="fas fa-angle-right"></i> My Account</a>
         </div>

         <div class="box">
            <h3>contact info</h3>
            <p> <a href="tel:+27621127909"> <i class="fas fa-phone"></i> +27 62 112 7909 </a>
            <p> <a href="mailto:theonetshik@gmail.com"> <i class="fas fa-envelope"></i> theonetshik@gmail.com </a>
            <p> <a href="https://goo.gl/maps/geo5jKh6H9bvQVNc9"> <i class="fas fa-map-marker-alt"></i> malamulele, south
                  africa - 0982 </p> </a>
         </div>

         <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/profile.php?id=100046590500835&mibextid=ZbWKwL"> <i
                  class="fab fa-facebook-f"></i> facebook </a>
            <a href="https://www.twitter.com"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="https://www.instagram.com"> <i class="fab fa-instagram"></i> instagram </a>
         </div>
      </section>

      <!-------------------------------------------------------------- Back to Top -------------------------------------------------------------------------------------------->
      <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

   </footer>

   <script src="./assets/js/script.js"></script>

   <script>

      // JavaScript to handle showing/hiding container2 and back functionality
      document.addEventListener("DOMContentLoaded", function () {
         // Get references to the elements
         const container2 = document.querySelector(".container2");
         const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");
         const addCartIcon = document.getElementById("add-to-cart-icon");
         const productContent = document.querySelector(".home-category");
         const header = document.querySelector(".header");
         const footer = document.querySelector(".footer");
         const backButton = document.createElement("a");

         // Add a click event listener to the "Add to Cart" icon
         addCartIcon.addEventListener("click", function (event) {
            // Prevent the default action (e.g., following the link)
            event.preventDefault();

            // Hide the header
            header.style.display = "none";

            // Hide the footer
            footer.style.display = "none";

            // Hide the product content
            productContent.style.display = "none";

            // Show the container2
            container2.style.display = "block";



            addToCartButtons.forEach(function (button) {
               button.addEventListener("click", function () {
                  const itemName = button.getAttribute("data-name");
                  const itemPrice = parseFloat(button.getAttribute("data-price"));
                  addToCart(itemName, itemPrice);
               });
            });

            // Create a back button
            backButton.href = "javascript:void(0);";  // JavaScript void to prevent navigation
            backButton.innerHTML = '<i class="fas fa-arrow-left"></i> Back';
            backButton.classList.add("back-button");
            container2.appendChild(backButton);

            // Add a click event listener to the back button to go back to the previous page
            backButton.addEventListener("click", function () {
               container2.style.display = "none"; // Hide container2
               header.style.display = "block"; // Show the header
               footer.style.display = "block"; // Show the footer
               productContent.style.display = "block"; // Show the product content
               container2.removeChild(backButton); // Remove the back button
            });
         });
      });
   </script>

</body>

</html>