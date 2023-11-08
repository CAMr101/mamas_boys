<?php

function getOrders()
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        $query = "SELECT * FROM `shop_order`;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll();


        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }

}

function getProduct($id)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        $query = "SELECT *
        FROM product
        WHERE id = $id;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll();


        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
}