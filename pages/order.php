<?php

include "../components/header.php";
include "../components/footer.php";
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");

session_start();

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$orderId = $pathParams[1];

$order = getOrder($orderId);
$orderItems = json_decode($order['order_items'], true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>

    <?php include "../components/customer-meta-data.php"; ?>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">
    <link rel="stylesheet" href="../assets/css/account-page.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }
    </style>

</head>

<body>

    <!------------------------------------------------------------------- Header Section --------------------------------------------------------------------------------->

    <?php
    echo createHeader();
    ?>

    <?php include "../components/customer-nav.php"; ?>

    <main class="main-content">

        <ul class="insights">
            <a>
                <li>
                    <span class="info">
                        <h3>Order #
                            <?php echo ($order["id"]); ?>
                        </h3>
                    </span>
                </li>
            </a>
        </ul>

        <ul class="insights">
            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            badge
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            echo ($order["name"]);
                            ?>
                        </h3>
                        <p>
                            Name
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            alternate_email
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            echo ($order["email"]);
                            ?>
                        </h3>
                        <p>
                            Email
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            dialpad
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            echo ($order["phone"]);
                            ?>
                        </h3>
                        <p>
                            Phone number
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            calendar_month
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            echo ($order["created_at"]);
                            ?>
                        </h3>
                        <p>
                            Date Created
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            payments
                        </span>
                    </i>
                    <span class="info">
                        <h3> R
                            <?php
                            echo ($order["order_total"]);
                            ?>
                        </h3>
                        <p>
                            Order Total
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            credit_card
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            echo ($order["payment_method"]);
                            ?>
                        </h3>
                        <p>
                            Payment Method
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            attach_money
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            $result = "";
                            if ($order["paid"] == 0)
                                $result = "No";
                            if ($order["paid"] == 1)
                                $result = "Yes";
                            echo $result;
                            ?>
                        </h3>
                        <p>
                            Paid
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            done_all
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php echo ($order["order_status"]); ?>
                        </h3>
                        <p>

                        </p>
                    </span>
                </li>
            </a>
        </ul>

        <ul class="insights">
            <a>
                <li>
                    <span class="info">
                        Order Item
                    </span>
                </li>
            </a>
        </ul>

        <div class="bottom-data">
            <div class="orders">

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Ingredients</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orderItems as $item) {
                            $productId = $item['id'];
                            $product = getProduct($productId);

                            if ($product !== null) {
                                ?>
                        <tr>
                            <td>
                                <a href="product.php?id=<?php echo $product['id']; ?>">
                                    <?php echo $product['name']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="product.php?id=<?php echo $product['id']; ?>">
                                    <?php echo $item['quantity']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="product.php?id=<?php echo $product['id']; ?>">
                                    <?php echo $product['description']; ?>
                                </a>
                            </td>

                        </tr>
                        <?php
                            } else {
                                echo 'No Products';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>

    </main>

    <?php
    echo createFooter();
    ?>


    <script src="../assets/js/main.js"></script>


</body>

</html>