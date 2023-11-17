<?php

session_start();

include "../components/header.php";
include "../components/footer.php";
include "../components/customer-meta-data.php";
include "../handlers/processReviews.php";
include "../handlers/processCustomer.php";

$name;
$email;

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


    <title> Reviews</title>

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

    <section class="reviews">

        <h1 class="title">client reviews</h1>

        <div class="box">

        </div>

        </div>

        <div class="box-container">
            <?php

            // Number of reviews to display per page
            $reviewsPerPage = 6;

            // Calculate the total number of pages
            $totalPages = ceil(count($reviews) / $reviewsPerPage);

            // Get the current page from the URL parameter, default to 1
            $currentPage = isset($_GET['page']) ? max(1, $_GET['page']) : 1;

            // Calculate the starting index for the reviews array based on the current page
            $startIndex = ($currentPage - 1) * $reviewsPerPage;

            // Get a subset of reviews based on the current page
            $displayedReviews = array_slice($reviews, $startIndex, $reviewsPerPage);

            // ...
            
            // Display reviews for the current page
            foreach ($displayedReviews as $review) {
                echo '<div class="box">';
                echo '<p>' . htmlspecialchars($review['review']) . '</p>';
                echo '<div class="stars">';
                for ($i = 0; $i < $review['rating']; $i++) {
                    echo '<i class="fas fa-star"></i>';
                }
                echo '</div>';

                echo '<h3>' . htmlspecialchars($review['name']) . '</h3>';
                echo '</div>';
            }


            // Display pagination links
            echo '<div class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i == $currentPage) ? 'active' : '';
                echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
            }
            echo '</div>';
            ?>
        </div>

        <br><br>
        <!-- Add review form -->
        <div class="box">
            <h3>WRITE A REVIEW</h3>

            <form method="post" action="../handlers/processReviews.php">
                <label for="email">Email:</label> <br><br>
                <input type="email" name="email" placeholder="Enter your Email" required>
                <br><br>
                <label for="name">Full Name:</label> <br><br>
                <input type="text" name="name" placeholder="Enter your full name" required>
                <br><br>
                <label for="review">Your Review:</label> <br>
                <textarea name="review" placeholder="Share details of your own experience at this place"
                    required></textarea>
                <br><br>
                <label for="rating">Rating:</label>
                <select name="rating" required>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>

                <input type="submit" name="submit_review" value="Submit Review" class="btn">
            </form>
        </div>
    </section>

    <!-------------------------------------------------------------------- Footer Section ---------------------------------------------------------------------------------->
    <?php
    echo createFooter();
    ?>


    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/confirmDelete.js"></script>

</body>

</html>