<?php
function createHeader()
{

   if (isset($_SESSION["customer_id"])) {
      $thisName = ucfirst($_SESSION["customer_name"]);
      $subject = '
      <header class="header">
      <div class="flex">

         <a href="index.php">
            <img src="./assets/images/logo.png" width=70px alt="" id="header-logo">
         </a>

         <a href="index.php">
            <h1> MAMAS BOYS KOTA AND CHIPS</h1>
         </a>


         <div class="new">
            <a href="#">Home</a>
            <a href="./pages/products.php">Shop</a>
            <a href="./pages/about.php">About</a>
            <a href="./pages/contact.php">Contact</a>

         </div>

         <div class="icons">
            <a href="./pages/account.php"> <id="user-btn" class="fas fa-user"></id>
                  <a href="./pages/cart.php" id="add-to-cart-icon" class="fas fa-shopping-cart"> <span
                        id="count">0</span></a>
         </div>

         <div class="profile">

            <a href="user_profile_update.html" class="btn">update profile</a>
            <a href="../handlers/logout.php" class="delete-btn">logout</a>
            <div class="flex-btn">
               <a href="./pages/login.php" class="option-btn">login</a>
               <a href="./pages/signup.php" class="option-btn">register</a>
            </div>
         </div>
      </div>
   </header>
      ';
      $search = '<id="user-btn" class="fas fa-user">';

      $newHeader = str_replace($search, $thisName, $subject);

      return $newHeader;
   } else {
      return '
      <header class="header">
      <div class="flex">

         <a href="index.php">
            <img src="./assets/images/logo.png" width=70px alt="" id="header-logo">
         </a>

         <a href="index.php">
            <h1> MAMAS BOYS KOTA AND CHIPS</h1>
         </a>


         <div class="new">
            <a href="#">Home</a>
            <a href="./pages/products.php">Shop</a>
            <a href="./pages/about.php">About</a>
            <a href="./pages/contact.php">Contact</a>

         </div>

         <div class="icons">
            <a href="./pages/login.php"> <id="user-btn" class="fas fa-user"></id>
                  <a href="./pages/cart.php" id="add-to-cart-icon" class="fas fa-shopping-cart"> <span
                        id="count">0</span></a>
         </div>

         <div class="profile">

            <a href="user_profile_update.html" class="btn">update profile</a>
            <a href="../handlers/logout.php" class="delete-btn">logout</a>
            <div class="flex-btn">
               <a href="./pages/login.php" class="option-btn">login</a>
               <a href="./pages/signup.php" class="option-btn">register</a>
            </div>
         </div>
      </div>
   </header>
        ';
   }


}

?>