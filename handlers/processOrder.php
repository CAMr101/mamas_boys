<?php
//get all orders from the db
function getOrders()
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM `shop_order`;";

            $stmt = $pdo->prepare($query);

            $stmt->execute();
            $result = $stmt->fetchAll();


            $pdo = null;
            $stmt = null;

            return $result;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }



    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }

}

//get the sum of the order_total row to display the total sales
function getTotal()
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

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

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }

}
