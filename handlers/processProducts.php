<?php
if (isset($_REQUEST['delete'])) {
    $productId = $_GET['delete'];

    deleteProduct($productId);
}

if (isset($_REQUEST['update'])) {
    $categoryId = $_GET['update'];

    updateProduct($categoryId);
    echo '11';
}

function getAllProducts()
{
    include "../config/dbh.inc.php";

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
}

function getProduct($id)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM product WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $product = $result[0];

        $pdo = null;
        $stmt = null;

        return $product;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getProductName($id)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT name FROM product WHERE id = $id;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getProductsByCategoryId($id)
{
    include "../config/dbh.inc.php";

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
}

function deleteProductByCategoryId($id)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM product WHERE category_id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // foreach ($result as $row) {
        //     deleteImageByProductId($row['id']);
        // }
        echo (json_encode($result));
        return;

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

function updateProduct($id)
{
    include 'processImage.php';


    $updateProdUrl = "../admin/edit-product.php";
    $productUrl = "../admin/product.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $mime_types = ["image/png", "image/jpeg"];
        $error = '';
        $destination;

        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['ingredients'];
        $category = $_POST['category'];
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


                    header("location:$updateProdUrl?id=$id error=$error");
            }
        } else if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
            $image = null;
        } else if (!in_array($_FILES["image"]["type"], $mime_types)) {
            $error = "Invalid file type";
            header("location:$updateProdUrl?error=$error");
        } else if ($_FILES["image"]["size"] > 7864320) {
            $error = 'Exceeded filesize limit.';
            header("location:$updateProdUrl?error=$error");
        } else {
            $image = $_FILES["image"];

            $pathInfo = pathinfo($_FILES["image"]["name"]);
            $base = $pathInfo["filename"];
            $base = preg_replace("/[^\w-]/", "_", $base);
            $fileName = $base . "." . $pathInfo["extension"];

            $destination = "../assets/images/category/" . $fileName;
            if (!move_uploaded_file($image["tmp_name"], $destination)) {
                $error = "Could not move file: Save unsuccessful";
                header("location:$updateProdUrl?error=$error");
            }
        }


        try {
            include "../config/dbh.inc.php";

            $query = "SELECT id FROM category WHERE name = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$category]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $categoryId = $result[0]["id"];

            if ($image != null) {
                updateProductImageLocation($id, $destination, $image["name"]);

            }

            $query = "UPDATE `product` SET `name`=?, `price`=?, `description`=?, `category_id`=? WHERE id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $price, $description, $categoryId, $id]);

            $pdo = null;
            $stmt = null;

            header("location:$productUrl?id=$id");

            // die();

        } catch (PDOException $e) {
            echo (0);
            die("Query Failed: " . $e->getMessage());
        }
    } else {
        header("location:../admin/shop.php");
    }
}

function deleteProduct($id)
{
    include "../config/dbh.inc.php";
    include 'processImage.php';

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // deleteImageByProductId($id);

        $query = "DELETE FROM `product` WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $pdo = null;
        $stmt = null;

        header("location:../admin/products.php");

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}