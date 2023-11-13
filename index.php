<?php
session_start();

include "./components/footer.component.php";
include "./components/header.component.php";

$header = "";

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

   $header = str_replace($search, $thisName, $subject);
} else {

   $header = '
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

if (isset($_REQUEST['login'])) {
   $code = $_REQUEST['login'];

   switch ($code) {
      case "success":
         $nameLoggedIn = ucfirst($_SESSION["customer_name"]);
         $message = "Welcome back $nameLoggedIn";
         echo "<script>alert('$message');</script>";
         break;
      default:
         break;
   }
}

if (isset($_REQUEST['logout'])) {
   $code = $_REQUEST['logout'];

   switch ($code) {
      case true:
         $message = "Successfully logged out.";
         echo "<script>alert('$message');</script>";
         break;
      default:
         break;
   }
}

$categories = getAllCategories();

function getAllCategories()
{
   include "./config/dbh.inc.php";

   try {
      $query = "SELECT * FROM category";
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


      $pdo = null;
      $stmt = null;

      return $result;

   } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
   }
}
function getImageByCategoryId($catId)
{
   include "./config/dbh.inc.php";

   try {

      $query = "SELECT name, location FROM images WHERE category_id = ?;";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$catId]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $pdo = null;
      $stmt = null;

      if (empty($result)) {
         return null;
      } else {
         return $result[0];
      }

   } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="keywords" content="Mams Boys Kota & Chips">
   <meta name="description"
      content="Founded by Nhlanhla Theobold Mabasa, a culinary enthusiast with a passion for creating simple yet exceptional South African street cuisine. 
                                                The food truck has gained a loyal following of food enthusiasts and has become a go-to spot for foodies seeking trusted and flavourful experiences.
                                                With a background in the vibrant culture of street food, Nhlanhla decided to venture out and create his own brand. His aspiration is for his brand to center around the customer's complete immersion in the diverse array of flavors presented by the distinctive taste of the country. The client exclusively offers street food, specializing in kota’s and chips.">
   <meta name="author" content="p-themes">
   <!-- Favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="./assets/icons/favicon.png">
   <meta name="apple-mobile-web-app-title" content="Mams Boys Kota & Chips">
   <meta name="application-name" content="Mams Boys Kota & Chips">
   <meta name="theme-color" content="#ffffff">
   <title>home page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="./assets/css/style.css">
   <link rel="stylesheet" href="./assets/css/style3.css">
   <link rel="stylesheet" href="./assets/css/product-page.css">
   <link rel="stylesheet" href="./assets/css/addtocart.css">

</head>

<body>

   <?php
   echo $header;
   ?>

   <style>
      .home-bg {
         background-image: url("./assets/images/kota8.png");
      }
   </style>

   <div class="home-bg">

      <section class="home">
         <div class="content">
            <h3>Satisfy Your Craving.</h3>
            <p>We are bringing you the best kota selling business ever.</p>
            <a href="./pages/products.php" class="btn">Shop</a>
         </div>
      </section>
   </div>


   <section class="home-category">
      <h1 class="title">Our Categories</h1>
      <br>
      <div class="box-container">
         <?php
         foreach ($categories as $category) {
            $image = getImageByCategoryId($category["id"]); ?>
            <div class="box">
               <img src="<?php
               if ($image)
                  echo ($image['location']);
               ?>" alt="<?php
               if ($image) {
                  echo ($image['name']);
               } else {
                  echo "'" . $category['name'] . "' " . "Image not found";
               }

               ?>">
               <a href="./pages/category.php?id=<?php echo ($category['id']); ?>" class="btn">
                  <?php echo ($category['name']); ?>
               </a>
            </div>
            <?php
         }
         ?>

      </div>
      <br>

      <h1 class="title">Best Seller</h1>
      <br>
      <div class="box-container">

         <div class="box">
            <img src="assets/images/bacon.jpeg" alt="">
            <h3>R13</h3>
            <button class="btn add-to-cart-btn" data-name="Bacon" data-price="13" onclick="addtocart(19)">ADD TO
               CART</button>
         </div>

         <div class="box">
            <img src="assets/images/okota1.jpg" alt="">
            <h3>R80</h3>
            <button class="btn add-to-cart-btn" data-name="OKota" data-price="80" onclick="addtocart(7)">ADD TO
               CART</button>
         </div>

         <div class="box">
            <img src="assets/images/kota cheese.png" alt="">
            <h3>R23</h3>
            <button class="btn add-to-cart-btn" data-name="kota cheese" data-price="23" onclick="addtocart(5)">ADD TO
               CART</button>
         </div>

         <div class="box">
            <img src="assets/images/small chips 2.webp" alt="">
            <h3>R55</h3>
            <button class="btn add-to-cart-btn" data-name="small chips 2" data-price="55" onclick="addtocart(10)">ADD
               TO
               CART</button>
         </div>

      </div>
   </section>
   <br>

   <footer class="footer">
      <section class="box-container">
         <div class="box">
            <h3>quick links</h3>
            <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
            <a href="./pages/products.php"> <i class="fas fa-angle-right"></i> Shop</a>
            <a href="./pages/about.php"> <i class="fas fa-angle-right"></i> About Us</a>
            <a href="./pages/contact.php"> <i class="fas fa-angle-right"></i> Contact Us</a>
         </div>

         <div class="box">
            <h3>Additional Links</h3>
            <a href="./pages/cart.php"> <i class="fas fa-angle-right"></i> Cart</a>
            <a href="./pages/login.php"> <i class="fas fa-angle-right"></i> Login</a>
            <a href="./pages/signup.php"> <i class="fas fa-angle-right"></i> Create Account</a>
            <a href="./admin/login.php"> <i class="fas fa-angle-right"></i> Admin Dashboard</a>
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

      <div class="bottom-box"></div>

   </footer>

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