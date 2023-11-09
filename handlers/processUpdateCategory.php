<?php
include 'processImage.php';

$newCategoryUrl = "../admin/edit-category.php";
$categoryUrl = "../admin/category.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mime_types = ["image/png", "image/jpeg"];
    $error = '';
    $destination;

    $categoryId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image;


    if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {


        switch ($_FILES['image']['error']) {
            case UPLOAD_ERR_PARTIAL:
                $error = 'File upload not complete';
            case UPLOAD_ERR_NO_FILE:
                $error = 'No file sent.';
            case UPLOAD_ERR_EXTENSION:
                $error = 'File upload stopped by PHP extention';
            case UPLOAD_ERR_INI_SIZE:
                $error = 'File exceeds upload_max_filesize in php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                $error = 'Exceeded filesize limit.';
            case UPLOAD_ERR_NO_TMP_DIR:
                $error = 'Temporary folder not found';
            case UPLOAD_ERR_CANT_WRITE:
                $error = 'Failed to save';
            default:
                $error = 'Unknown errors.';


                header("location:$newCategoryUrl?error=$error");
        }
    } else if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
        $image = null;
    } else if (!in_array($_FILES["image"]["type"], $mime_types)) {
        $error = "Invalid file type";
        header("location:$newCategoryUrl?error=$error");
    } else if ($_FILES["image"]["size"] > 7864320) {
        $error = 'Exceeded filesize limit.';
        header("location:$newCategoryUrl?error=$error");
    } else {
        $image = $_FILES["image"];

        $pathInfo = pathinfo($_FILES["image"]["name"]);
        $base = $pathInfo["filename"];
        $base = preg_replace("/[^\w-]/", "_", $base);
        $fileName = $base . "." . $pathInfo["extension"];

        $destination = "../assets/images/category/" . $fileName;
        if (!move_uploaded_file($image["tmp_name"], $destination)) {
            $error = "Could not move file: Save unsuccessful";
            header("location:$newCategoryUrl?error=$error");
        }
    }


    try {
        require_once "../config/dbh.inc.php";

        if ($image != null) {
            updateCategoryImageLocation($categoryId, $destination, $image["name"]);
        }

        $query = "UPDATE `category` SET `name`=?, `description`=? WHERE id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $description, $categoryId]);

        $query = "SELECT * FROM category WHERE id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$categoryId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categoryId = $result[0];

        $pdo = null;
        $stmt = null;

        header("location:$categoryUrl?id=$categoryId");

        die();

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("location:../admin/shop.php");
}