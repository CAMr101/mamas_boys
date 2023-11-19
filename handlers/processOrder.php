<?php

//Update order status
if (isset($_REQUEST['uos']) && isset($_POST)) {
    $orderId = $_GET['uos'];
    $status = $_POST['orderStatus'];

    updateOrderStatus($orderId, $status);
}

//update paid: Yes or No
if (isset($_REQUEST['uop']) && isset($_POST)) {

    $orderId = $_GET['uop'];
    $paid = $_POST['made_payment'];

    switch ($paid) {
        case "No":
            updatePaymentValue($orderId, 0);
            break;
        case "Yes":
            updatePaymentValue($orderId, 1);
            break;
        default:
            header("location:../admin/order.php?id=$orderId&error=update");
            break;
    }
}

//New Order
if (isset($_POST) && isset($_REQUEST['cd'])) {
    $code = $_GET['cd'];

    if ($code == 1)
        createNewOrder();
    else
        echo "Null";
}

//get all orders from the db
function getOrders()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM `shop_order` ORDER BY `shop_order`.`created_at` DESC;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll();


        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function createNewOrder()
{
    $data = file_get_contents("php://input");
    $customerOrder = json_decode($data, true);

    if ($customerOrder["cId"] != "") {
        $cId = $customerOrder["cId"];
        $registerd = true;

    } else {
        $cId = null;
        $registerd = false;
    }
    $cName = $customerOrder["cName"];
    $cEmail = $customerOrder["cEmail"];
    $cPhone = $customerOrder["cPhone"];
    $orderTotal = $customerOrder["orderTotal"];
    $orderItems = json_encode($customerOrder["orderItems"]);
    $paymentMethod = $customerOrder["paymentMethod"];
    $paid = 0;
    $status = "NotStarted";


    try {
        include "../config/dbh.inc.php";
        include "../handlers/email.php";

        $query = "INSERT INTO shop_order (customer_id, name, email, phone, order_total, order_items, order_status, payment_method, paid) 
            VALUES (?,?,?,?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$cId, $cName, $cEmail, $cPhone, $orderTotal, $orderItems, $status, $paymentMethod, $paid]);

        $query = "SELECT * FROM `shop_order` WHERE name=? AND email=? AND phone=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$cName, $cEmail, $cPhone]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $order = $result[count($result) - 1];

        $pdo = null;
        $stmt = null;

        if ($paymentMethod === "cash") {
            sendOrderConfirmationEmail($order);
        }

        echo json_encode($order);

        die();

    } catch (PDOException $e) {
        echo "false";
        die("Query Failed: " . $e->getMessage());
    }
}

function getOrder($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM shop_order WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $order = $result;

        $pdo = null;
        $stmt = null;

        return $order;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getOrderByCustomerId($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM shop_order WHERE customer_id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

//get the sum of the order_total row to display the total sales
function getTotal()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT SUM(order_total) AS totalSales FROM shop_order;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $pdo = null;
        $stmt = null;

        return $result[0]["totalSales"];

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


}

function updateOrderStatus($id, $status)
{
    include "../config/dbh.inc.php";

    try {

        $query = "UPDATE `shop_order` SET `order_status`=?  WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$status, $id]);

        $pdo = null;
        $stmt = null;

        header("location:../admin/order.php?id=$id");

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function updatePaymentValue($id, $paid)
{
    include "../config/dbh.inc.php";

    try {

        $query = "UPDATE `shop_order` SET `paid`=?  WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$paid, $id]);

        $pdo = null;
        $stmt = null;

        header("location:../admin/order.php?id=$id&success=update");

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function updateOrderAfterPayment($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "UPDATE `shop_order` SET `paid`=1 WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
