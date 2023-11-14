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
        <a href="">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        payments
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Sales
                    </h3>
                    <p>Report</p>
                </span>
            </li>
        </a>


        <a href="">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        inventory_2
                    </span>
                </i>
                <span class="info">
                    <h3>Products</h3>
                    <p>Report</p>
                </span>
            </li>
        </a>
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


    </ul>

</main>



</body>

</html>