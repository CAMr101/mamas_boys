<?php
function createFooter()
{
   return '
    <footer class="footer">
    <section class="box-container">
       <div class="box">
          <h3>quick links</h3>
          <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
          <a href="products.php"> <i class="fas fa-angle-right"></i> Shop</a>
          <a href="about.php"> <i class="fas fa-angle-right"></i> About Us</a>
          <a href="Contact.php"> <i class="fas fa-angle-right"></i> Contact Us</a>
       </div>

       <div class="box">
          <h3>Additional Links</h3>
          <a href="cart.php"> <i class="fas fa-angle-right"></i> Cart</a>
          <a href="Login.php"> <i class="fas fa-angle-right"></i> Login</a>
          <a href="signup.php"> <i class="fas fa-angle-right"></i> Create Account</a>
          <a href="./admin/login.php"> <i class="fas fa-angle-right"></i> Admin Dashboard</a>
       </div>

       <div class="box">
          <h3>contact info</h3>
          <p> <a href="tel:+27621127909"> <i class="fas fa-phone"></i> +27 62 112 7909 </a>
          <p> <a href="mailto:theonetshik@gmail.com"> <i class="fas fa-envelope"></i> theonetshik@gmail.com </a>
          <p> <a href="https://goo.gl/maps/geo5jKh6H9bvQVNc9"> <i class="fas fa-map-marker-alt"></i> malamulele, south africa - 0982 </p> </a>
       </div>

       <div class="box">
          <h3>follow us</h3>
          <a href="https://www.facebook.com/profile.php?id=100046590500835&mibextid=ZbWKwL"> <i class="fab fa-facebook-f"></i> facebook </a>
          <a href="https://www.twitter.com"> <i class="fab fa-twitter"></i> twitter </a>
          <a href="https://www.instagram.com"> <i class="fab fa-instagram"></i> instagram </a>
       </div>
    </section>

    <div class="bottom-box"></div>

 </footer>
            ';
}


?>