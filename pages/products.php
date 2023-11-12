<?php

session_start();

include "../components/header.php";
include "../components/footer.php";
include "../handlers/processCategory.php";
include "../handlers/processProducts.php";
include "../handlers/processImage.php";

$categories = getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/product-page.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">

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

        <?php

        foreach ($categories as $category) {
            $products = getProductsByCategoryId($category["id"]); ?>
            <h1 class="title">
                <?php echo ($category['name']); ?>
            </h1>
            <div class="box-container" id="product-container">
                <?php
                foreach ($products as $product) {
                    $image = getImageByProductId($product['id']); ?>
                    <div class="box">
                        <img class="prod-img" src="<?php
                        if ($image)
                            echo ($image['location']);
                        ?>" alt="<?php
                        if ($image) {
                            echo ($image['name']);
                        } else {
                            echo "'" . $product['name'] . "' " . "Image not found";
                        } ?>">
                        <h2>
                            <?php echo ($product['name']); ?>
                        </h2>
                        <p>
                            <?php echo ($product['description']); ?>
                        </p>
                        <h3>R
                            <?php echo ($product['price']); ?>
                        </h3>
                        <button class="btn add-to-cart-btn" data-name="<?php echo ($product['name']); ?>"
                            data-price="<?php echo ($product['price']); ?>"
                            onclick="addtocart(<?php echo ($product['id']); ?>)">ADD TO CART</button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <br>
            <?php
        }
        ?>

    </section>

    <?php
    echo createFooter();
    ?>

    <script src="../assets/js/main.js"></script>
    <!-- <script src="./assets/js/product-page.js"></script> -->
    <script src="../assets/js/addToCart.js"></script>

</body>

</html>