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

   <style>
      /* Initially hide container2 */
      .container2 {
         display: none;
      }
   </style>

</head>

<body>

   <!------------------------------------------------------------------- Header Section --------------------------------------------------------------------------------->
   <!-- <div class="container2">
   <div id="root"></div>
     <div class="sidebar">
        <div class="head"><h4>My Cart</h4></div>
        <div id="cart-list">Your cart is empty</div>
        <div class="foot">
           <h2 id="cart-total">R 0.00</h2>
      <a href="checkouts.php" class="btn proceed-to-checkout-btn">Proceed to Checkout</a>
        </div> 
       </div>
        </div>
     </div>
</div> -->




   <?php
   echo createHeader();
   ?>


   <section class="home-category">


      <h1 class="title">KOTA</h1>
      <div class="box-container" id="product-container">

         <!-- <div class="box">
            <img src="Website pictures\kota vienna 2.jpg" alt="">
            <h2>Toyota</h2>
            <p>Bread, Atchar, Polony, Chips & Vienna</p>
            <h3>R22</h3>
            <button class="btn add-to-cart-btn" data-name="Toyota" data-price="22">ADD TO CART</button>
         </div> -->

      </div>
      <br><br><br><br>
   </section>

   <?php
   echo createFooter();
   ?>

   <script src="./assets/js/main.js"></script>
   <script src="./assets/js/kota-page.js"></script>
   <script src="./assets/js/addToCart.js"></script>

   <!-- <script>
   // JavaScript to handle showing/hiding container2 and back functionality
   document.addEventListener("DOMContentLoaded", function() {
      // Get references to the elements
      const container2 = document.querySelector(".container2");
      const addCartIcon = document.getElementById("add-to-cart-icon");
      const productContent = document.querySelector(".home-category");
      const header = document.querySelector(".header");
      const footer = document.querySelector(".footer");
      const backButton = document.createElement("a");

      // Add a click event listener to the "Add to Cart" icon
      addCartIcon.addEventListener("click", function(event) {
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

         // Create a back button
         backButton.href = "javascript:void(0);";  // JavaScript void to prevent navigation
         backButton.innerHTML = '<i class="fas fa-arrow-left"></i> Back';
         backButton.classList.add("back-button");
         container2.appendChild(backButton);

         // Add a click event listener to the back button to go back to the previous page
         backButton.addEventListener("click", function() {
            container2.style.display = "none"; // Hide container2
            header.style.display = "block"; // Show the header
            footer.style.display = "block"; // Show the footer
            productContent.style.display = "block"; // Show the product content
            container2.removeChild(backButton); // Remove the back button
         });
      });
   });
</script> -->

</body>

</html>