<?php



function getTotal()
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

        $query = "SELECT SUM(order_total) FROM shop_order;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $pdo = null;
        $stmt = null;

        return $result[0]["SUM(order_total)"];

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }

}


?>