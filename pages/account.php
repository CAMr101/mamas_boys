<?php
include "../components/header.php";
include "../components/footer.php";
include "../handlers/processCustomer.php";
include "../handlers/processOrder.php";


session_start();

if (isset($_SESSION["customer_id"])) {
    $userId = $_SESSION["customer_id"];
    $user = getCustomer($userId);
    $orders = getOrderByCustomerId($userId);

} else {
    header("location:login.php?login=denied");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website meta data -->
    <?php include "../components/customer-meta-data.php"; ?>


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
                        <h3>
                            <?php echo ucfirst($user['name']) . " " . ucfirst($user['surname']); ?>
                        </h3>
                        <p>User</p>
                    </span>
                </li>
            </a>


            <a href="products.php">
                <li>
                    <span class="info">
                        <h3>
                            <?php echo $user['email']; ?>
                        </h3>
                        <p>Email</p>
                    </span>
                </li>
            </a>
            <a href="#">
                <li>
                    <span class="info">
                        <h3>
                            <?php echo $user['phone'] ?>
                        </h3>
                        <p>Phone Number</p>
                    </span>
                </li>
            </a>
        </ul>
        <ul class="insights">
            <a href="edit-account.php?id=<?php echo $user['id'] ?>">
                <li>
                    <span class="info">
                        <h3> Edit Account</h3>

                    </span>
                    <p><span class="material-symbols-outlined">
                            edit
                        </span></p>
                </li>
            </a>

        </ul>
        <ul class="insights">
            <a>
                <li>
                    <span class="info">
                        <h3>Orders</h3>
                    </span>
                </li>
            </a>
        </ul>

        <div class="bottom-data">
            <div class="orders">

                <table>
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th colspan="">Order Items</th>
                            <th colspan="">Quantity</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        if ($orders !== null) {
                            foreach ($orders as $order) { ?>

                        <tr>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['id']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['name']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['email']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['phone']; ?>
                                </a>
                            </td>
                            <td colspan="1">
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php
                                    $order_items = json_decode($order['order_items'], true);

                                    foreach ($order_items as $item) {
                                        $name = getProductName($item['id']);
                                        echo $name['name'];
                                        echo "<br>";
                                    } ?>
                                </a>
                            </td>
                            <td colspan="1">
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php
                                    $order_items = json_decode($order['order_items'], true);

                                    foreach ($order_items as $item) {
                                        echo $item['quantity'];
                                        echo "<br>";
                                    } ?>

                                </a>
                            </td>
                            <td>R
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['order_total']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['created_at']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="order.php?id=<?php echo $order['id']; ?>">
                                    <?php echo $order['payment_method']; ?>
                                </a>
                            </td>
                            <td>
                                <span class="status <?php
                                switch ($order['order_status']) {
                                    case 'NotStarted':
                                        echo 'notStarted';
                                        break;
                                    case 'Started':
                                        echo 'pending';
                                        break;
                                    case 'Ready':
                                        echo 'ready';
                                        break;
                                    case 'Completed':
                                        echo 'completed';
                                        break;
                                    case 'Cancelled':
                                        echo 'cancelled';
                                        break;
                                    default:
                                        echo 'pending';
                                        break;
                                }
                                ?>">
                                    <?php
                                    switch ($order['order_status']) {
                                        case 'NotStarted':
                                            echo 'Not Started';
                                            break;
                                        case 'Started':
                                            echo 'Started';
                                            break;
                                        case 'Ready':
                                            echo 'Ready';
                                            break;
                                        case 'Completed':
                                            echo 'Completed';
                                            break;
                                        case 'Cancelled':
                                            echo 'Cancelled';
                                            break;
                                        default:
                                            echo 'none';
                                            break;
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>

                        <?php }
                        } else {
                            echo "No products found";
                        }
                        ?>

                        <!-- <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status process">Processing</span></td>
                        </tr> -->
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