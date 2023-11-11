<?php
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");
include("../handlers/enums/order-status.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$orderId = $pathParams[1];

$order = getOrder($orderId);
$orderItems = json_decode($order['order_items'], true);

?>


<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>

<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                Order #
                <?php
                echo ($order["id"]);
                ?>
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="orders.php">
                        Orders
                    </a>
                </li>
                /
                <li>
                    <a href="#" class="active">
                        <?php
                        echo ($order["id"]);
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="insights">
        <a>
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        badge
                    </span>
                </i>
                <span class="info">
                    <h3>
                        <?php
                        echo ($order["name"]);
                        ?>
                    </h3>
                    <p>
                        Name
                    </p>
                </span>
            </li>
        </a>

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
                        echo ($order["email"]);
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
                        echo ($order["phone"]);
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
                        echo ($order["created_at"]);
                        ?>
                    </h3>
                    <p>
                        Date Created
                    </p>
                </span>
            </li>
        </a>

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
                        echo ($order["order_total"]);
                        ?>
                    </h3>
                    <p>
                        Order Total
                    </p>
                </span>
            </li>
        </a>

        <a>
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        credit_card
                    </span>
                </i>
                <span class="info">
                    <h3>
                        <?php
                        echo ($order["payment_method"]);
                        ?>
                    </h3>
                    <p>
                        Payment Method
                    </p>
                </span>
            </li>
        </a>

        <a>
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        attach_money
                    </span>
                </i>
                <span class="info">
                    <h3>
                        <?php
                        $result = "";
                        if ($order["paid"] == 0)
                            $result = "No";
                        if ($order["paid"] == 1)
                            $result = "Yes";
                        echo $result;
                        ?>
                    </h3>
                    <p>
                        Paid
                    </p>
                </span>
            </li>
        </a>

        <a>
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        done_all
                    </span>
                </i>
                <span class="info">
                    <datalist id="order_status">
                        <?php foreach (OrderStatus::cases() as $status) { ?>
                            <option value="<?php echo ($status->name) ?>"></option>
                        <?php } ?>
                    </datalist>
                    <h3>
                        <?php echo ($order["order_status"]); ?>
                    </h3>
                    <p>
                    <form action="../handlers/processOrder.php?uos=<?php echo ($order["id"]); ?>" method="post"
                        id="updateOrderStatus">
                        <input form="updateOrderStatus" list="order_status" name="orderStatus" value="">
                        <button type="submit">Save</button>
                    </form>
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
                    <?php echo count($orderItems); ?>
                    Order Item(s)
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