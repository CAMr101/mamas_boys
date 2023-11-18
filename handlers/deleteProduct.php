<?php
include 'processImage.php';

$newCategoryUrl = "../admin/edit-category.php";
$categoryUrl = "../admin/category.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $categoryId = $_POST['id'];

    try {
        include "../config/dbh.inc.php";

        $query = "DELETE FROM `product` WHERE id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$categoryId]);


        header('Location:../admin/products.php');

        die();

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header('Location:../admin/products.php');
}