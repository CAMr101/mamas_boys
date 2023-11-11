<?php
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$orders = getOrders();
$numOfOrders = count($orders);

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>Orders</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="reports.php">
                        Reports
                    </a>
                </li>
                /
                <li>
                    <a href="#" class="active">Orders</a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="insights">
        <a href="">
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        payments
                    </span>
                </i>
                <span class="info">
                    <h3>
                        <?php echo $numOfOrders; ?>
                    </h3>
                    <p>Total Orders</p>
                </span>
            </li>
        </a>

        <a href="../handlers/generateReport.php?id=3">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        description
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Generate
                    </h3>
                    <p>Report</p>
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
                                        $productName = getProductName($order_items[0]['id']);

                                        echo $productName[0]['name']; ?>
                                        <br>
                                        <?php
                                        $order_items = json_decode($order['order_items'], true);
                                        $productName = getProductName($order_items[1]['id']);

                                        echo $productName[0]['name']; ?>
                                    </a>
                                </td>
                                <td colspan="1">
                                    <a href="order.php?id=<?php echo $order['id']; ?>">
                                        <?php
                                        $order_items = json_decode($order['order_items'], true);
                                        $item = $order_items[0]['quantity'];

                                        echo $order_items[0]['quantity']; ?>
                                        <br>
                                        <?php
                                        $order_items = json_decode($order['order_items'], true);
                                        $item = $order_items[0]['quantity'];

                                        echo $order_items[1]['quantity']; ?>
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



</body>

</html>