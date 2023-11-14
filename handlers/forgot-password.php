<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)) {
    $email = $_POST["reset-email"];


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
        header("location:../pages/forgot-password?error=error");
        echo "Connection failed: " . $e->getMessage();
    }
}