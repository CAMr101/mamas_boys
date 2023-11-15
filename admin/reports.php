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

        <!-- <a href="">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        payments
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Product Sales
                    </h3>
                    <p>Report</p>
                </span>
            </li>
        </a> -->
    </ul>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>
                    Results
                </h3>
            </div>

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



</body>

</html>