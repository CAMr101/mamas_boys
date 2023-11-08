<?php
include("./handlers/processTotalSales.php");
include("./handlers/getOrders.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./assets/css/admin.new.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

    <!-- Side Nav -->
    <div class="side-nav">
        <a href="admin.html" class="logo">
            <img src="./assets/images/logo.png" alt="Mama's Boy's Logo">
        </a>
        <ul class="side-menu">
            <li class="side-menu-item">
                <a href="admin.php">Dashboard</a>
            </li>
            <li class="side-menu-item">
                <a href="admin/orders.html">Orders</a>
            </li>
            <li class="side-menu-item">
                <a href="admin/shop.html">Shop</a>
            </li>
            <!-- <li class="side-menu-item">
                <a href="/admin/staff.html">Staff</a>
            </li> -->
        </ul>
        <ul class="side-menu">
            <li class="side-menu-item">
                <a href="">Logout</a>
            </li>
        </ul>
    </div>


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
                            <th colspan="2">Order Items</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                        </tr>

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

                                        echo $order_items[0]['id']; ?>
                                        <br>
                                        Mustang
                                    </td>
                                    <td colspan="1">
                                        <?php
                                        $order_items = json_decode($order['order_items'], true);

                                        echo $order_items[0]['quantity']; ?>
                                        <br>
                                        1
                                    </td>
                                    <td>R
                                        <?php echo $order['order_total']; ?>
                                    </td>
                                    <td>
                                        <?php echo $order['created_at']; ?>
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