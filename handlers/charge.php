<?php
session_start();

require_once "../components/header.php";
require_once "../components/footer.php";
require_once "../handlers/processProducts.php";
require_once "../handlers/processImage.php";
require_once "../handlers/processCustomer.php";
require_once "../handlers/processOrder.php";
require_once "../handlers/email.php";

require_once __DIR__ . '/../vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51ODNYCLv9rtmG82r6OvQ7vtwiqbdoKepx8RtlNunVDvsXopH4qbzROPzr7a2mfFHJrISmnthxrGBoV4QZsB51nuc00bXI6Qybb');

// Token is created using Stripe.js or Checkout!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$orderAmountInCents = $_POST['orderAmountInCents'];
if (isset($_POST['id'])) {
    $order = getOrder($_POST['id']);
}
// Charge the user's card:
try {
    $charge = \Stripe\Charge::create([
        'amount' => $orderAmountInCents,
        'currency' => 'zar',
        'description' => 'Example Charge',
        'source' => $token,
    ]);

    // Handle successful payment (e.g., update order status, redirect to thank you page)
    // echo 'Payment successful! Thank you for your purchase.';
    updateOrderAfterPayment($order['id']);
    $mailSent = sendOrderConfirmationEmail($order);
    if ($mailSent === false) {
        header('location:../index.php?error=mail');
    }
    header('location:../pages/order-success.php');
} catch (\Stripe\Exception\CardException $e) {
    // Handle card errors (e.g., insufficient funds, card declined)
    echo 'Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\RateLimitException $e) {
    // Too many requests made to the API too quickly
    echo 'Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Invalid parameters were supplied to Stripe's API
    echo 'Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\AuthenticationException $e) {
    // Authentication with Stripe's API failed
    echo 'Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\ApiConnectionException $e) {
    // Network communication with Stripe failed
    echo 'Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Generic error
    echo 'Error: ' . $e->getError()->message;
}

?>