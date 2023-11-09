<?php

function saveCategoryImage($name, $location, $catId)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO images (name, location, category_id) 
            VALUES (?,?,?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $location, $catId]);

            $query = "SELECT id FROM images WHERE category_id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$catId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $imageId = $result[0]["id"];


            $pdo = null;
            $stmt = null;

            return $imageId;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
}

function saveProductImage($name, $location, $prodId)
{
    require_once "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO images (name, location, product_id) 
            VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $location, $prodId]);

        $query = "SELECT id FROM images WHERE name = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $imageId = $result[0]["id"];


        $pdo = null;
        $stmt = null;

        return $imageId;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getImageByCategoryId($catId)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT name, location FROM images WHERE category_id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$catId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pdo = null;
            $stmt = null;

            if (empty($result)) {
                return null;
            } else {
                return $result[0];
            }

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
}

function getImageByProductId($prodId)
{
    try {
        $dsn = "mysql:host=localhost;dbname=mamas_boys";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT name, location FROM images WHERE product_id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$prodId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pdo = null;
            $stmt = null;

            if (empty($result)) {
                return null;
            } else {
                return $result[0];
            }

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
}

function updateCategoryImageLocation($id, $location, $name)
{
    require_once "../config/dbh.inc.php";

    try {
        $query = "UPDATE `images` SET `location`=?, `name`=? WHERE category_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$location, $name, $id]);

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function updateProductImageLocation($id, $location, $name)
{
    require_once "../config/dbh.inc.php";

    try {
        $query = "UPDATE `images` SET `location`=?, `name`=? WHERE product_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$location, $name, $id]);

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function deleteImageByProductId($productId)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "DELETE FROM `product` WHERE product_id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
