<?php

session_start();

include('Configuration.php');
include "./components/footer.component.php";
include "./components/header.component.php";
//include('session.php'); 

if (isset($_POST['contact']))

   // Define variables to handle form submission
   $firstName = $lastName = $email = $phoneNumber = $message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $firstName = $_POST["firstName"];
   $lastName = $_POST["lastName"];
   $email = $_POST["email"];
   $phoneNumber = $_POST["phoneNumber"];
   $message = $_POST["message"];

   // Prepare and execute an SQL INSERT statement to insert data into the messages table
   $sql = "INSERT INTO messages (firstName, lastName, email, phoneNumber, message) 
            VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$message')";

   if ($connection->query($sql) === TRUE) {
      echo '<p class="success"> Message sent successfully!</p>';
   } else {
      echo '<p class="error"> Message not sent!</p>';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>

   <!--link to css-->
   <link rel="stylesheet" href="./assets/css/contactStyle.css">
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

   <?php
   echo createHeader();
   ?>

   <!-- <div class="container2">
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
   </div>
   </div> -->

   <!---------------------------------------------------- Content Section ------------------------------------------------------------------------------------->
   <div class="contactUs">
      <div class="heading">
         <h2>Get in touch with us!</h2>
      </div>



      <!------------------------------------------------------------------------- the contact form itself------------------------------------------------------------->
      <div class="contactSections">
         <div class="contact form">
            <h3>Leave us a message</h3>

            <form method="post" action="" name="contact-form">
               <div class="formSection">
                  <div class="sectionInfo">
                     <div class="inputBox">
                        <span>First Name</span>
                        <input type="text" name="firstName" required>
                     </div>

                     <div class="inputBox">
                        <span>Last Name</span>
                        <input type="text" name="lastName" required>
                     </div>
                  </div>

                  <div class="sectionInfo">
                     <div class="inputBox">
                        <span>Email</span>
                        <input type="text" name="email" required>
                     </div>

                     <div class="inputBox">
                        <span>Phone Number</span>
                        <input type="text" name="phoneNumber" required>
                     </div>
                  </div>

                  <div class="sectionMessage">
                     <div class="inputBox">
                        <span>Message</span>
                        <textarea placeholder="Penny for your thoughts..." name="message" required></textarea>
                     </div>
                  </div>

                  <div class="sectionMessage">
                     <div class="inputBox">
                        <input type="submit" value="Send">
                     </div>
                  </div>

               </div>
            </form>
         </div>

         <!---------------------------------------------------------- The contact details box------------------------------------------------------------------------>
         <div class="contact details">
            <h3>Contact Details</h3>
            <div class="detailsBox">
               <div>
                  <span><i class="fa-solid fa-location-dot"></i></span>
                  <p>Malamulele, Limpopo</p>
               </div>
               <div>
                  <span><i class="fa-solid fa-envelope"></i></span>
                  <a href="mailto:amasBoys@gmail.com">theonetshik@gmail.com</a>
               </div>

               <div>
                  <span><i class="fa-solid fa-phone"></i></span>
                  <a href="tel:064 905 6958">+27 62 112 7909</a>
               </div>

               <!--Social media links-->
               <ul class="socialLinks">
                  <li><a href="https://www.facebook.com/profile.php?id=100046590500835&mibextid=ZbWKwL"><i
                           class="fa-brands fa-facebook"></i></a></li>
                  <li><a href="www.instagram.com"><i class="fa-brands fa-instagram"></i></a></li>
               </ul>

            </div>
         </div>

         <!------------------------------------------------------------ The contact map box------------------------------------------------------------------------------>

         <div class="contact map">
            <iframe
               src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d772.0967389195683!2d30.696596923201547!3d-22.
         996890017627244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ec5b03103cc342d%3A0xf33dd2e04c0494f2!2sMalamulele%20Hospital!5e0!3m2!1sen!2sza!4v1696608075295!5m2!1sen!2sza"
               style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
         </div>
      </div>
   </div>

   <!-------------------------------------------------------------------- Footer Section ---------------------------------------------------------------------------------->
   <?php
   echo createFooter();
   ?>

   <!--link to fontawesome icons-->
   <script src="https://kit.fontawesome.com/1cc9d41456.js" crossorigin="anonymous"></script>

   <script src="./assets/js/main.js"></script>
   <script src="./assets/js/script.js"></script>

   <!-- <script>
      // JavaScript to handle showing/hiding container2 and back functionality
      document.addEventListener("DOMContentLoaded", function() {
         // Get references to the elements
         const container2 = document.querySelector(".container2");
         const addCartIcon = document.getElementById("add-to-cart-icon");
         const header = document.querySelector(".header");
         const contactUs = document.querySelector(".contactUs");
         const footer = document.querySelector(".footer");
         const backButton = document.createElement("a");

         // Add a click event listener to the "Add to Cart" icon
         addCartIcon.addEventListener("click", function(event) {
            // Prevent the default action (e.g., following the link)
            event.preventDefault();

            // Hide the header
            header.style.display = "none";

            // Hide the contact us section
            contactUs.style.display = "none";

            // Hide the footer
            footer.style.display = "none";

            // Show the container2
            container2.style.display = "block";

            // Create a back button
            backButton.href = "javascript:void(0)"; // JavaScript void to prevent navigation
            backButton.innerHTML = '<i class="fas fa-arrow-left"></i> Back';
            backButton.classList.add("back-button");
            container2.appendChild(backButton);

            // Add a click event listener to the back button to go back to the previous page
            backButton.addEventListener("click", function() {
               container2.style.display = "none"; // Hide container2
               header.style.display = "block"; // Show the header
               contactUs.style.display = "block"; // Show the contact us section
               footer.style.display = "block"; // Show the footer
               container2.removeChild(backButton); // Remove the back button
            });
         });
      });
   </script> -->



</body>

</html>