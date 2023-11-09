<?php

if (isset($_REQUEST['uos']) && isset($_POST)) {
    $orderId = $_GET['uos'];
    $status = $_POST['orderStatus'];

    updateOrderStatus($orderId, $status);
}

//get all orders from the db
function getOrders()
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

function getOrder($id)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM shop_order WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $order = $result[0];

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
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
