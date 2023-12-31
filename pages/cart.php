<?php
session_start();

include "../components/header.php";
include "../components/footer.php";
include "../handlers/processProducts.php";
include "../handlers/processImage.php";

$products = [];
$counter = 0;

if (isset($_COOKIE['usercart'])) {
    $cart = json_decode($_COOKIE['usercart'], true);
    if (isset($cart)) {
        foreach ($cart as $item) {
            $products[$counter] = getProduct($item['id']);
            $products[$counter]['quantity'] = $item['quantity'];
            $counter++;
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website meta data -->
    <?php include "../components/customer-meta-data.php"; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/cart-page.css">
    <style>
        /* Add your mobile-specific styles here */
        @media only screen and (max-width: 600px) {

            .cart-container {
                flex-direction: column;
                display: flex;
                justify-content: space-evenly;
                margin: 0;
            }

            .cart-summary {
                color: black;
                margin: 0;
            }

            .cart-item {
                margin-bottom: 2%;
                display: flex;
                flex-direction: column;
                font-size: 5%;
                margin: 0;
            }

            .cart-item .prod-image img {
                margin: 0;
                width: 100%;
                box-sizing: border-box;
                margin-bottom: 2%;
                display: flex;
                justify-content: space-evenly;
                padding: 15px;
            }

            .details .prod .prod-name {
                display: flex;
                width: 100%;
                justify-content: space-evenly;
                margin: 0;
                padding: 15px;
                /* Add padding for better spacing */
            }

            .details {
                display: flex;
                flex-direction: column;
            }

            .details p {
                margin: 5px 10px 7px;
            }

            .buttons {
                margin-top: 5px;
                display: flex;
                justify-content: space-evenly;
            }

            .quantity,
            .unit-price,
            .total-price {
                margin: 0;
                width: 100%;
                display: flex;
                margin-right: 10px;
                justify-content: space-evenly;
            }

            .cart-summary {
                margin-top: 20px;
                box-sizing: content-box;
                width: 100%;
                padding: 20px;
            }

            .sub-total,
            .grand-total {
                display: flex;
                justify-content: space-evenly;
            }

            .btn {
                width: 100%;
                background-color: aqua;
                color: black;
            }

            .btn:hover {
                background-color: aquamarine;
                color: grey;
            }

        }
    </style>
    <title>My Cart</title>
</head>

<body>

    <?php
    echo createHeader();
    ?>

    <main>
        <div class="main-div">
            <div class="cart-container">
                <div class="cart">
                    <p class="heading" id="heading">Cart Items</p>
                    <div class="cart-items" id="cart-items">

                        <?php
                        if (!isset($cart)) {
                            echo '<h2> Cart is empty. </h2>';
                        }
                        ?>

                        <?php
                        foreach ($products as $product) {
                            $image = getImageByProductId($product['id']); ?>
                            <div class="cart-item">
                                <div class="prod-image">
                                    <img src="<?php
                                    if ($image)
                                        echo ($image['location']);
                                    ?>" alt="<?php
                                    if ($image) {
                                        echo ($image['name']);
                                    } else {
                                        echo "'" . $product['name'] . "' " . "Image not found";
                                    } ?>">
                                </div>

                                <div class="details">
                                    <div class="prod">
                                        <p class="prod-name">
                                            <?php echo ($product['name']); ?>
                                        </p>
                                        <p class="prod-ingredient">
                                            <?php if ($product['description'])
                                                echo ($product['description']); ?>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="price">Unit Price</p>
                                        <p class="unit-price">
                                            R <span id="unit-price">
                                                <?php echo ($product['price']); ?>
                                            </span>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="quantity">Quantity</p>
                                        <!-- <input type="number" name="quantity" min="1" id="quantity" class="quantity-input"> -->

                                        <div class="buttons">
                                            <button type="button" class="decrease"
                                                onclick="decreaseQuantity(<?php echo ($product['id']); ?>)">-</button>

                                            <span class="number" id="prod-quantity">
                                                <?php echo ($product['quantity']); ?>
                                            </span>

                                            <button type="button" class="increase"
                                                onclick="increaseQuantity(<?php echo ($product['id']); ?>)">+</button>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="total-price">Total</p>
                                        <p class="summedPrice-container">
                                            R <span class="summed-price" id="total-prod-price"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <!-- <div class="cart-item">
                            <div class="prod-image">
                                <img src="assets/images/kota.jpg" alt="Kota 1">
                            </div>
                            
                            <div class="details">
                                <div class="prod">
                                    <p class="prod-name">Porche</p>
                                    <p class="prod-ingredient">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque tempore, illum laboriosam culpa suscipit numquam magni at perferendis voluptatum accusantium molestiae, amet officia cupiditate.
                                    </p>
                                </div>
    
                                <div>
                                    <p class="price">Unit Price</p>
                                    <p class="unit-price">
                                        R <span id="unit-price">25.00</span>
                                    </p>
                                </div>
    
                                <div>
                                    <p class="quantity">Quantity</p>
                                    <!-- <input type="number" name="quantity" min="1" id="quantity" class="quantity-input"> 

                                    <div class="buttons">
                                        <button type="button" class="decrease">-</button>

                                        <span class="number">1</span>

                                        <button type="button" class="increase">+</button>
                                    </div>
                                </div>
    
                                <div>
                                    <p class="total-price">Total</p>
                                    <p class="">
                                        R <span id="summed-price">25.00</span>
                                    </p>
                                </div>
                            </div>
        
                        </div> -->
                    </div>
                </div>

                <div class="cart-summary">
                    <p class="heading">Summary</p>
                    <hr class="line">
                    <div class="sub-total">
                        <p>Subtotal</p>
                        <p class="price">R
                            <span id="subtotal-amount">0</span>
                        </p>
                    </div>
                    <hr class="line">
                    <div class="grand-total">
                        <p>Order Total</p>
                        <p class="total">R
                            <span id="total-amount">0</span>
                        </p>
                    </div>

                    <a href="checkout.php">
                        <button type="button" class="btn primary-btn">Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <?php
    echo createFooter();
    ?>

    <script src="https://js.stripe.com/v3/"></script>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/cart-page.js"></script>
</body>

</html>