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

   <?php
   echo createHeader();
   ?>

   <section class="home-category" id="main-body">

   </section>

   <?php
   echo createFooter();
   ?>

   <script src="./assets/js/main.js"></script>
   <script src="./assets/js/product-page.js"></script>
   <script src="addtocart.js"></script>

</body>

</html>