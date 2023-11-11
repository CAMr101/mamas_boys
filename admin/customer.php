<?php
include("../handlers/processOrder.php");
include("../handlers/processCustomer.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$customerId = $pathParams[1];

$customer = getCustomer($customerId);
$orders = getOrderByCustomerId($customerId);

?>


<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>

<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                <?php
                echo ($customer["name"]);
                ?>
                <?php
                echo ($customer["surname"]);
                ?>
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="customer.php">
                        Customer
                    </a>
                </li>
                /
                <li>
                    <a href="#" class="active">
                        <?php
                        echo ($customer["id"]);
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="insights">
        <a>
            <li>
                <!-- <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        alternate_email
                    </span>
                </i> -->
                <span class="info">
                    <h3>
                        <?php
                        echo ($customer["email"]);
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
                        echo ($customer["phone"]);
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
                        echo ($customer["created_at"]);
                        ?>
                    </h3>
                    <p>
                        Date Created
                    </p>
                </span>
            </li>
        </a>
    </ul>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>
                    <?php echo count($orders); ?>
                    Order Item(s)
                </h3>
            </div>

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
                        echo "No orders found";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</main>