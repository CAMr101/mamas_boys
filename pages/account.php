<?php
include "../components/header.php";
include "../components/footer.php";
include "../handlers/processCustomer.php";
include "../handlers/processOrder.php";


session_start();

if (isset($_SESSION["customer_id"])) {
    $customerId = $_SESSION["customer_id"];
    $cusomterData = getCustomer($customerId);
    $orders = getOrderByCustomerId($customerId);

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
                        <h3>Name Surname</h3>
                        <p>User</p>
                    </span>
                </li>
            </a>


            <a href="products.php">
                <li>
                    <span class="info">
                        <h3>Email</h3>
                        <p>Email</p>
                    </span>
                </li>
            </a>
            <a href="#">
                <li>
                    <span class="info">
                        <h3>
                            Number
                        </h3>
                        <p>Phone Number</p>
                    </span>
                </li>
            </a>
        </ul>
        <ul class="insights">
            <a href="edit-account.php">
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