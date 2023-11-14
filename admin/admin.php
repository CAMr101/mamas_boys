<?php
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");
include("../handlers/processStaff.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$user = getStaffById($_SESSION['user_id']);
$orders = getOrders();
$authorise;


if ($user['type'] != 'admin') {
    $authorise = false;
    $total = "--";
} else {
    $authorise = true;
    $total = getTotal();
}


if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case "notauthorised":
            $message = "Not authorised to perform action.";
            echo "<script>alert('$message');</script>";
            break;
        case "view":
            $message = "Not allowed to view this page.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            $message = "Something went wrong. please try again";
            echo "<script>alert('$message');</script>";
            break;
    }
}

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>Dashboard</h1>
            <!-- <ul class="breadcrumb">
                    <li><a href="#">
                            Analytics
                        </a></li>
                    /
                    <li><a href="#" class="active">Shop</a></li>
                </ul> -->
        </div>
    </div>

    <ul class="insights">
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
                        echo $total;
                        ?>

                    </h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </a>


        <a href="products.php">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        inventory_2
                    </span>
                </i>
                <span class="info">
                    <h3>Products</h3>
                    <p>View All Products</p>
                </span>
            </li>
        </a>

        <?php
        if ($authorise == true)
            echo `
            <a href="reports.php">
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
        `;
        ?>
    </ul>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Recent Orders</h3>
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



</body>

</html>