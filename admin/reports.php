<?php
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");
include("../handlers/processStaff.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$user = getStaffById($_SESSION['user_id']);

if ($user['type'] != 'admin') {
    header('location:../admin/admin.php?error=view');
}

$orders = null;

if (isset($_REQUEST['start']) && isset($_REQUEST['end'])) {

    $start_date = $_REQUEST['start'];
    $end_date = $_REQUEST['end'];

    include "../config/dbh.inc.php";

    try {
        $query = "SELECT * FROM shop_order WHERE created_at BETWEEN '$start_date' AND '$end_date'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!isset($result)) {
            $orders = null;
        } else {
            $orders = $result;
        }

        $query = "SELECT SUM(order_total) AS totalSales FROM shop_order WHERE created_at BETWEEN '$start_date' AND '$end_date'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sum =  $result[0]["totalSales"];

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
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
            <h1>Reports</h1>
        </div>
    </div>

    <ul class="insights">
        <a href="order-report.php">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        orders
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Order
                    </h3>
                    <p> Report</p>
                </span>
            </li>
        </a>

        <a href="">
            <li>
                <span class="info">
                    <form action="../handlers/generateReport.php" method="post">
                        <table>
                            <tr>
                                <td>
                                    <label for="start_date">Start Date:</label>
                                </td>
                                <td>
                                    <input type="date" id="start_date" name="start_date" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="end_date">End Date:</label>
                                </td>
                                <td>
                                    <input type="date" id="end_date" name="end_date" required>
                                </td>
                            </tr>
                        </table>

                        <button>Generate</button>
                    </form>
                    <!-- <h3>
                        Sort Params
                    </h3> -->
                </span>
            </li>
        </a>

    </ul>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>
                    Sales: R <?php echo $sum; ?>
                    
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

                                        foreach ($order_items as $item) {
                                            $name = getProductName($item['id']);
                                            if (empty($name))
                                                echo "N/A";
                                            else
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