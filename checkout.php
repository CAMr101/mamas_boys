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
    <link rel="stylesheet" href="./assets/css/checkout-page.css">
    <title>Checkout</title>
</head>

<body>

    <?php
    echo createHeader();
    ?>

    <!-- Page body/content -->
    <div class="main-div">

        <a href="products.html" id="back-to-shop">
            <p id="back-shop-txt"> Back To Shop</p>
        </a>

        <div class="order">
            <div class="summary">
                <p class="heading">Order Summary</p>
                <hr>
                <div class="items" id="items-container">

                </div>
                <hr>
                <div class="discount">
                    <p>Discount</p>
                    <p class="amount">--</p>
                </div>

                <div class="total">
                    <p>Sub Total</p>
                    <p>
                        R <span class="total-amount" id="total-amount">0</span>
                    </p>
                </div>
            </div>

            <form action="" class="contact-form">
                <div class="contact-info">
                    <h6>Contact Info</h6>
                    <div class="info">
                        <div class="name">
                            <label for="cName">Name</label>
                            <input type="text" name="cName" id="customer-name">
                        </div>

                        <div class="email">
                            <label for="cEmail">Email</label>
                            <input type="email" name="cEmail" id="customer-email">
                        </div>

                        <div class="telephone">
                            <label for="cPhone">Telephone</label>
                            <input type="number" name="cPhone" id="customer-phone">
                        </div>
                    </div>

                    <div class="save-button" onclick="saveContactInfo()">
                        <button type="button" class="saveBtn">
                            Save
                        </button>
                    </div>
                </div>
            </form>


            <div class="complete">
                <div class="methods">
                    <p>Payment Method</p>
                    <div class="method" onclick="paymentOptionOnClick(0)">
                        <div>
                            <span class="card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" width="25">
                                    <path
                                        d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z" />
                                </svg>
                            </span>
                            <p>Card</p>
                        </div>
                        <span class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
                            </svg>
                        </span>
                    </div>

                    <div class="payment-details payment-inactive" id="payment-details">
                        <form action="" class="payment-form">
                            <h6>Enter Payment Details</h6>
                            <table>
                                <div class="name">
                                    <tr>
                                        <td>
                                            <label for="nameOnCard">Name On Card</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="1">
                                            <input type="text" id="nameOnCard" name="nameOnCard"
                                                placeholder="Name On Card">
                                        </td>
                                    </tr>
                                </div>

                                <div class="card-number">
                                    <tr>
                                        <td>
                                            <label for="cardNumber">Card Number</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="number" id="cardNumber" name="cardNumber"
                                                placeholder="Card Number">
                                        </td>
                                    </tr>
                                </div>

                                <div class="expiry">
                                    <tr>
                                        <td>
                                            <label for="expiry">Expiration Date</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="date" id="expiry" name="expiry">
                                        </td>
                                    </tr>
                                </div>
                                <div class="security-code">
                                    <tr>
                                        <td>
                                            <label for="cvv"> Security Code</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="number" id="cvv" name="cvv" max="3">
                                        </td>
                                    </tr>
                                </div>
                            </table>
                        </form>
                    </div>

                    <div class="method" onclick="paymentOptionOnClick(1)">
                        <div>
                            <span class="cash-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path
                                        d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z" />
                                </svg>
                            </span>
                            <p>Cash</p>
                        </div>
                        <span class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class=" complete-order">
                    <button type="button" class="btn" onclick="completeOrder()">Complete Order</button>
                </div>
            </div>
        </div>

    </div>

    <!-- footer -->
    <?php
    echo createFooter();
    ?>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/checkout-page.js"></script>

</body>

</html>