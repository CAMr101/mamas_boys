<?php
session_start();

include "../components/header.php";
include "../components/footer.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Complete</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="../assets/css/success-page.css">
</head>

<body>

    <?php
    echo createHeader();
    ?>

    <section id="thankYou" class="hidden">
        <h1>Thank You for Ordering with Mama's Boy's! &#x1F60B;</h1>
        <p>Your order receipt will be sent via email.</p>
        <button class="button" onclick="redirect()">
            OK
        </button>
    </section>

    <section class="unsuccessful text-center hidden" id="unsuccessful">
        <h1>Something Went Wrong.
            <br>Could Not Place Your Order.
        </h1>
        <p>Please Try Again Later.</p>
        <button class="button" onclick="redirect()">
            OK
        </button>
    </section>

    <?php
    echo createFooter();
    ?>

    <script src="../assets/js/order-complete.js"></script>
    <script src="../assets/js/main.js"></script>

</body>

</html>