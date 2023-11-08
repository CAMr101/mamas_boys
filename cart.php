<?php

include("Configuration.php");
include "./components/footer.component.php";
include "./components/header.component.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/root.css">
    <link rel="stylesheet" href="./assets/css/cart-page.css">
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

    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/cart-page.js"></script>
</body>

</html>