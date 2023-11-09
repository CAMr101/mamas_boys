<?php

function getAllCategories()
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

function getCategoryName($id)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT name FROM category WHERE id = $id;";

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


function newCategory($name, $description, $image)
{
    include 'processImage.php';

    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO category (name, description, image_id) VALUES (?,?,?);";

            $stmt = $pdo->prepare($query);

            $stmt->execute([$name, $description, $imageId]);
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