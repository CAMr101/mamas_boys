<?php
session_start();

include("Configuration.php");
include "./components/footer.component.php";
include "./components/header.component.php";

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
   <link rel="stylesheet" href="./assets/css/product-page.css">
   <link rel="stylesheet" href="./assets/css/addtocart.css">

</head>

<body>

   <?php
   echo createHeader();
   ?>

   <style>
      .home-bg {
         background-image: url("Website pictures/kota8.png");
      }
   </style>

   <div class="home-bg">

      <section class="home">
         <div class="content">
            <h3>Satisfy Your Craving.</h3>
            <p>We are bringing you the best kota selling business ever.</p>
            <a href="products.php" class="btn">Shop</a>
         </div>
      </section>
   </div>


   <section class="home-category">
      <h1 class="title">Our Categories</h1>
      <br>
      <div class="box-container">
         <div class="box">
            <img src="Website pictures\kota3.jpg" alt="">
            <a href="kota.php" class="btn">KOTA</a>
         </div>

         <div class="box">
            <img src="Website pictures\french.jpg" alt="">
            <a href="chips.php" class="btn">CHIPS</a>
         </div>

         <div class="box">
            <img src="Website pictures\extra2.png" alt="">
            <a href="extras.php" class="btn">EXTRAS</a>
         </div>

      </div>
      <br>

      <h1 class="title">Best Seller</h1>
      <br>
      <div class="box-container">

         <div class="box">
            <img src="Website pictures\bacon.jpeg" alt="">
            <h3>R13</h3>
            <button class="btn add-to-cart-btn" data-name="Bacon" data-price="13" onclick="addtocart(19)">ADD TO
               CART</button>
         </div>

         <div class="box">
            <img src="Website pictures\okota1.jpg" alt="">
            <h3>R80</h3>
            <button class="btn add-to-cart-btn" data-name="OKota" data-price="80" onclick="addtocart(7)">ADD TO
               CART</button>
         </div>

         <div class="box">
            <img src="Website pictures\kota cheese.png" alt="">
            <h3>R23</h3>
            <button class="btn add-to-cart-btn" data-name="kota cheese" data-price="23" onclick="addtocart(5)">ADD TO
               CART</button>
         </div>

         <div class="box">
            <img src="Website pictures\small chips 2.webp" alt="">
            <h3>R55</h3>
            <button class="btn add-to-cart-btn" data-name="small chips 2" data-price="55" onclick="addtocart(10)">ADD TO
               CART</button>
         </div>

      </div>
   </section>
   <br>

   <?php
   echo createFooter();
   ?>

   <script src="./assets/js/main.js"></script>
   <script src="./assets/js/addToCart.js"></script>

   <?php
   // Handle adding items to the cart
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-to-cart"])) {
      $itemName = $_POST["item-name"];
      $itemPrice = $_POST["item-price"];

      // You can add the item to the cart array or store it in a database
   }
   ?>



</body>

</html>