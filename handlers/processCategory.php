<?php

if (isset($_REQUEST['delete'])) {
    $categoryId = $_GET['delete'];

    deleteCategory($categoryId);
}

function getAllCategories()
{
    include "../config/dbh.inc.php";

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
}

function getCategory($id)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM category WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $category = $result[0];

        $pdo = null;
        $stmt = null;

        return $category;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function getCategoryName($id)
{
    include "../config/dbh.inc.php";

    try {


        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT name FROM category WHERE id = $id;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categoryName = $result[0];


        $pdo = null;
        $stmt = null;

        return $categoryName;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function newCategory($name, $description, $image)
{
    include "../config/dbh.inc.php";
    include 'processImage.php';

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
}


function deleteCategory($id)
{
    include "../config/dbh.inc.php";
    include "processProducts.php";
    include 'processImage.php';

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // deleteProductByCategoryId($id);

        $query = "DELETE FROM `category` WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $pdo = null;
        $stmt = null;

        header("location:../admin/shop.php");

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}