<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && isset($_REQUEST['submit_highlights'])) {
    $products = $_POST['products'];
    $validProductsInput = validateProducts($products);

    if ($validProductsInput === count($products)) {
        setHighlight($products);
        header('location:../admin/highlight.php?success=true');

    } else {
        header('location:../admin/highlight.php?error=invalidProd');
    }



}
function getHighlights()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM product where is_highlight = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $pdo = null;
        $stmt = null;

        if (empty($result)) {
            return null;
        } else {
            return $result;
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function setHighlight($products)
{
    include "../config/dbh.inc.php";

    deleteHighlights();

    try {

        foreach ($products as $product) {
            $query = "UPDATE `product` SET `is_highlight`=1 WHERE name=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$product]);
        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function deleteHighlights()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM product where is_highlight = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            foreach ($result as $row) {
                $query = "UPDATE `product` SET `is_highlight`=0 WHERE id=?;";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$row['id']]);
            }
        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function validateProducts($products)
{
    include "processProducts.php";

    $prodList = getAllProducts();
    $found = 0;

    foreach ($prodList as $product) {
        if (in_array($product['name'], $products)) {
            $found++;
        }
    }

    return $found;
}