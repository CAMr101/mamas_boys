<?php

function saveCategoryImage($image, $categoryId)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM category";

            $stmt = $pdo->prepare($query);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

function saveProductImage($image, $productId)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM category";

            $stmt = $pdo->prepare($query);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


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