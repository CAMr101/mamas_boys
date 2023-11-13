<?php

function getCustomers()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT `id`, `name`, `surname`, `email`, `phone`, `created_at` FROM `customer` WHERE 1;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function getCustomer($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM customer WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}