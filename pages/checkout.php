<?php
session_start();

include "../components/header.php";
include "../components/footer.php";
include "../handlers/processProducts.php";
include "../handlers/processImage.php";
include "../handlers/processCustomer.php";

if (isset($_SESSION["customer_id"])) {
    $userId = $_SESSION["customer_id"];
    $user = getCustomer($userId);

}

$cart = json_decode($_COOKIE['usercart'], true);
$products = [];
$counter = 0;
$orderTotal = 0;

if (isset($cart)) {
    foreach ($cart as $item) {
        $products[$counter] = getProduct($item['id']);
        $products[$counter]['quantity'] = $item['quantity'];

        $orderTotal += $products[$counter]['price'] * $item['quantity'];

        $counter++;
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
    <link rel="stylesheet" href="../assets/css/checkout-page.css">
    <title>Checkout</title>
    <style>
        /* Mobile-friendly styles */
        @media only screen and (max-width: 600px) {
            .order {
                width: 100%;
                /* Ensure the image takes the full width */
                margin-bottom: 10px;
            }

            /* Adjust the styling for mobile devices */
            .summary,
            .contact-form,
            .complete {
                width: 100%;
                box-sizing: border-box;
                margin-bottom: 15px;
            }

            .item {
                display: flex;
                align-items: center;
                justify-content: space-evenly;
                margin-bottom: 10px;
            }

            .prod-info {
                flex: 1;
                padding-left: 10px;
            }

            .complete-order {
                text-align: center;
            }

            .contact-info,
            .save-button {
                width: 100%;
            }

            .method {
                display: flex;
                align-items: center;
                justify-content: space-evenly;
            }

            .payment-details {
                margin-top: 10px;
            }

            /* Add more styles as needed */
        }
    </style>
</head>

<body>

    <?php
    echo createHeader();
    ?>

    <!-- Page body/content -->
    <div class="main-div">

        <a href="products.php" id="back-to-shop">
            <p id="back-shop-txt"> Back To Shop</p>
        </a>

        <div class="order">
            <div class="summary">
                <p class="heading">Order Summary</p>
                <hr>
                <div class="items" id="items-container">
                    <?php
                    foreach ($products as $product) {
                        $image = getImageByProductId($product['id']); ?>
                        <div class="item">
                            <img src="<?php
                            if ($image)
                                echo ($image['location']);
                            ?>" alt="<?php
                            if ($image) {
                                echo ($image['name']);
                            } else {
                                echo "'" . $product['name'] . "' " . "Image not found";
                            } ?>">
                            <div class="prod-info">
                                <p>
                                    <span class="quantity">
                                        <?php echo ($product['quantity']); ?>
                                    </span>
                                    <span class="name"> x
                                        <?php echo ($product['name']); ?><span>
                                </p>
                                <p>
                                    R <span class="price">
                                        <?php echo ($product['price'] * $product['quantity']); ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <hr>
                <div class="discount">
                    <p>Discount</p>
                    <p class="amount">--</p>
                </div>

                <div class="total">
                    <p>Sub Total</p>
                    <p>
                        R <span class="total-amount" id="total-amount">
                            <?php echo ($orderTotal); ?>
                        </span>
                    </p>
                </div>
            </div>

            <form action="" class="contact-form">
                <div class="contact-info">
                    <h6>Contact Info</h6>
                    <div class="info">
                        <div class="name">
                            <label for="cName">Name</label>
                            <input type="hidden" name="cId" value="<?php if (isset($_SESSION["customer_id"])) {
                                if ($user) {
                                    echo $user['id'];
                                }
                            } ?>" id="cId">
                            <input type="text" name="cName" id="customer-name" value="<?php if (isset($_SESSION["customer_id"])) {
                                if ($user) {
                                    echo $user['name'];
                                }
                            } ?>">
                        </div>

                        <div class="email">
                            <label for="cEmail">Email</label>
                            <input type="email" name="cEmail" id="customer-email" value="<?php if (isset($_SESSION["customer_id"])) {
                                if ($user) {
                                    echo $user['email'];
                                }
                            } ?>">
                        </div>

                        <div class="telephone">
                            <label for="cPhone">Telephone</label>
                            <input type="tel" name="cPhone" id="customer-phone" value="<?php if (isset($_SESSION["customer_id"])) {
                                if ($user) {
                                    echo $user['phone'];
                                }
                            } ?>">
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
                        <!-- <form action="" class="payment-form">
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
                        </form> -->
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

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/checkout-page.js"></script>

</body>

</html>