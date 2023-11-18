<?php
session_start();

require_once "../components/header.php";
require_once "../components/footer.php";
require_once "../handlers/processProducts.php";
require_once "../handlers/processImage.php";
require_once "../handlers/processCustomer.php";

// Include Stripe PHP library
require_once __DIR__ . '/../vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51ODNYCLv9rtmG82r6OvQ7vtwiqbdoKepx8RtlNunVDvsXopH4qbzROPzr7a2mfFHJrISmnthxrGBoV4QZsB51nuc00bXI6Qybb');

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
        $product = getProduct($item['id']);
        $products[$counter] = $product;
        $products[$counter]['quantity'] = $item['quantity'];

        $orderTotal += $product['price'] * $item['quantity'];

        $counter++;
    }
}

// Use your own logic to calculate the order amount to be charged
$orderAmountInCents = $orderTotal * 100;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy"
        content="img-src 'self' https://q.stripe.com https://b.stripecdn.com https://js.stripe.com data:;">

    <!-- Stripe.js library -->
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Your existing head content -->
    <?php include "../components/customer-meta-data.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/checkout-page.css">
    <title>Checkout</title>
</head>

<body>
    <?php echo createHeader(); ?>
    <div class="main-div">
        <form action="http://localhost/mamas_boys-main/handlers/charge.php" method="post" id="payment-form">
            <div class="payment-details" id="payment-details">
                <input type="hidden" name="orderAmountInCents" value="<?php echo $orderAmountInCents; ?>">
                <h6>Payment Details</h6>
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                    </div>
                    <div id="card-errors" role="alert"></div>
                </div>

                <button type="submit">Submit Payment</button>
            </div>
        </form>
    </div>

    <!-- Your existing scripts here -->

    <!-- Stripe.js script -->
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51ODNYCLv9rtmG82rwR00okaSvRwGPqkZthBpGkOfS7y8a4MiJ4JBHjUiO4wcJBLRmFkX7YszuKIK3jmzbdYaG26K00lZrFqK90');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Create an instance of the card Element.
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server.
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form.
            form.submit();
        }
    </script>

    <!-- Your existing footer here -->

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/checkout-page.js"></script>

</body>

</html>