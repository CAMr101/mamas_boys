<?php



//inserting a new order into the DB
if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $customerOrder = json_decode($data, true);

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

        $query = "INSERT INTO shop_order (name, email, phone, order_total, order_items, order_status, payment_method, paid) 
        VALUES (?,?,?,?,?,?,?,?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$cName, $cEmail, $cPhone, $orderTotal, $orderItems, $status, $paymentMethod, $paid]);

        $pdo = null;
        $stmt = null;

        echo (1);

        die();

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("location:../index.php");
}