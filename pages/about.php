<?php

session_start();

include "../components/header.php";
include "../components/footer.php";
include "../components/customer-meta-data.php";
include "../handlers/processReviews.php";
include "../handlers/processCustomer.php";

if (isset($_SESSION["customer_id"])) {
    $userId = $_SESSION["customer_id"];
    $user = getCustomer($userId);

    if ($user === null) {
        $name = "";
        $email = "";
    } else {
        $name = $user["name"];
        $email = $user["email"];
    }

}

$reviews = getReviews();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website meta data -->
    <?php include "../components/customer-meta-data.php"; ?>


    <title>About Us</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">
    <link rel="stylesheet" href="../assets/css/review.css">

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }
    </style>

</head>

<body>

    <style>
        /* Add this to your existing styles or in a separate CSS file */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: #333;
            color: #fff;
        }
    </style>
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
                    creating simple yet exceptional South African street cuisine. The food truck has gained a loyal
                    following
                    of food enthusiasts and has become a go-to spot for foodies seeking trusted and flavourful
                    experiences.
                    With a background in the vibrant culture of street food, Nhlanhla decided to venture out and create
                    his
                    own brand. His aspiration is for his brand to center around the customer's complete immersion in the
                    diverse array of flavors presented by the distinctive taste of the country. The client exclusively
                    offers
                    street food, specializing in kota’s and chips. </p>
                <a href="contact.php" class="btn">contact us</a>
            </div>

        </div>

    </section>

    <section class="reviews">

        <h1 class="title">
            <a href="./reviews.php">See reviews</a>
        </h1>


    </section>

    <!-------------------------------------------------------------------- Footer Section ---------------------------------------------------------------------------------->
    <?php
    echo createFooter();
    ?>


    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/confirmDelete.js"></script>

</body>

</html>