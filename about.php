<?php

session_start();

include("Configuration.php");
include "./components/footer.component.php";
include "./components/header.component.php";
// Handle adding items to the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-to-cart"])) {
   $itemName = $_POST["item-name"];
   $itemPrice = $_POST["item-price"];

   // You can add the item to the cart array or store it in a database
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
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

   <?php
   echo createHeader();
   ?>

   <div class="container2">
      <div id="root"></div>
      <div class="sidebar">
         <div class="head">
            <h4>My Cart</h4>
         </div>
         <div id="cart-list">Your cart is empty</div>
         <div class="foot">
            <h2 id="cart-total">R 0.00</h2>
            <a href="checkouts.php" class="btn proceed-to-checkout-btn">Proceed to Checkout</a>
         </div>
      </div>
   </div>

   <section class="about">

      <div class="row">

         <div class="box">
            <h3>About Us</h3>
            <p>Mama’s Boys is a well-established food truck that has been serving the local community of Malamulele,
               Limpopo since 2018. Founded by Nhlanhla Theobold Mabasa, a culinary enthusiast with a passion for
               creating simple yet exceptional South African street cuisine. The food truck has gained a loyal following
               of food enthusiasts and has become a go-to spot for foodies seeking trusted and flavourful experiences.
               With a background in the vibrant culture of street food, Nhlanhla decided to venture out and create his
               own brand. His aspiration is for his brand to center around the customer's complete immersion in the
               diverse array of flavors presented by the distinctive taste of the country. The client exclusively offers
               street food, specializing in kota’s and chips. </p>
            <a href="contact.php" class="btn">contact us</a>
         </div>

      </div>

   </section>

   <section class="reviews">

      <h1 class="title">client reviews</h1>

      <div class="box-container">

         <div class="box">
            <img src="Website pictures\Glad2.webp" alt="">

            <p>I gave my patients a bite, and told them that the patient that will heal faster will get a full one. Now
               they are all saying that they are fully healed.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Masana Baloyi</h3>
         </div>

         <div class="box">
            <img src="Website pictures\Khosa.jpg" alt="">
            <p>Oh My Gosh! I didn't see this one coming. This is proper! Best kota I have ever eaten.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Nsovo Khosa</h3>
         </div>

         <div class="box">
            <img src="Website pictures\Bongi.jpg" alt="">
            <p>All I can say is, I love it, I love it, I love it. Keep it up guys. I have 0 regrets. I am even planning
               on buying more.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Bongani Libisi</h3>
         </div>

         <div class="box">
            <img src="Website pictures\Mathev.jpg" alt="">
            <p>Before even finishing my kota, I saw three hands asking for a bite, that's how inviting it is.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Hlori Mathevula</h3>
         </div>

         <div class="box">
            <img src="Website pictures\Maringa.jpg" alt="">
            <p>All I can say is thank you guys. Continue doing well!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ntshembo Maringa</h3>
         </div>

         <div class="box">
            <img src="Website pictures\Praise.jpg" alt="">
            <p>The reveiws I'm seeing are very impressive. I'm definitely buying one.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Hinteko Baloyi</h3>
         </div>

      </div>

   </section>

   <!-------------------------------------------------------------------- Footer Section ---------------------------------------------------------------------------------->
   <?php
   echo createFooter();
   ?>


   <script src="./assets/js/main.js"></script>

</body>

</html>