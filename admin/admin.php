<?php
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>

<!-- Top nav -->
<!-- <nav class="top-nav">
        <a href="#" class="notif">
            <i class='bx bx-bell'></i>
            <span class="count">0</span>
        </a>
        <a href="#" class="profile">
            <img src="./assets/images/logo.png">
        </a>
    </nav> -->


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
        <li><i class='bx bx-dollar-circle'>
                <span class="material-symbols-outlined">
                    payments
                </span>
            </i>
            <span class="info">
                <h3> R
                    <?php
                    $total = getTotal();
                    echo $total;
                    ?>

                </h3>
                <p>Total Sales</p>
            </span>
        </li>`

        <li><i class='bx bx-dollar-circle'>
                <span class="material-symbols-outlined">
                    description
                </span>
            </i>
            <span class="info">
                <h3>
                    Generate
                </h3>
                <p>Order Report</p>
            </span>
        </li>
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
                    <!-- <tr>
                            <td>001</td>
                            <td>Cameron</td>
                            <td>john@email.com</td>
                            <td>0671234567</td>
                            <td colspan="1">
                                Porche
                                <br>
                                Mustang
                            </td>
                            <td colspan="1">
                                2
                                <br>
                                1
                            </td>
                            <td>R 120</td>
                            <td>14-08-2023</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr> -->

                    <?php
                    $orders = getOrders();

                    if ($orders !== null) {
                        foreach ($orders as $order) { ?>

                            <tr>
                                <td>
                                    <?php echo $order['id']; ?>
                                </td>
                                <td>
                                    <?php echo $order['name']; ?>
                                </td>
                                <td>
                                    <?php echo $order['email']; ?>
                                </td>
                                <td>
                                    <?php echo $order['phone']; ?>
                                </td>
                                <td colspan="1">
                                    <?php
                                    $order_items = json_decode($order['order_items'], true);
                                    $productName = getProductName($order_items[0]['id']);

                                    echo $productName[0]['name']; ?>
                                    <br>
                                    <?php
                                    $order_items = json_decode($order['order_items'], true);
                                    $productName = getProductName($order_items[1]['id']);

                                    echo $productName[0]['name']; ?>
                                </td>
                                <td colspan="1">
                                    <?php
                                    $order_items = json_decode($order['order_items'], true);
                                    $item = $order_items[0]['quantity'];

                                    echo $order_items[0]['quantity']; ?>
                                    <br>
                                    <?php
                                    $order_items = json_decode($order['order_items'], true);
                                    $item = $order_items[0]['quantity'];

                                    echo $order_items[1]['quantity']; ?>
                                </td>
                                <td>R
                                    <?php echo $order['order_total']; ?>
                                </td>
                                <td>
                                    <?php echo $order['created_at']; ?>
                                </td>
                                <td>
                                    <?php echo $order['payment_method']; ?>
                                </td>
                                <td><span class="status completed">Completed</span></td>
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