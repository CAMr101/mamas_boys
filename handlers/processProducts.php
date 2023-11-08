<?php

function getAllProducts()
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM product";

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

function getProduct($id)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM product WHERE id = $id;";

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

function getProductName($id)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT name FROM product WHERE id = $id;";

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

function getProductsByCategoryId($id)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM product WHERE category_id=?";

            $stmt = $pdo->prepare($query);

            $stmt->execute([$id]);
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