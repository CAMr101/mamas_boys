<?php
include("../handlers/processCategory.php");
include("../handlers/processProducts.php");
include("../handlers/processImage.php");

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$productId = $pathParams[1];

$product = getProduct($productId);
$image = getImageByProductId($product["id"]);

$categoryName = getCategoryName($product["category_id"]);

print_r($categoryName["name"]);

if ($image == null) {
    $image["name"] = "Image not found";
    $image["location"] = "";
}

?>


<?php include '../components/admin-header.php'; ?>

<!-- Top nav -->
<!-- <nav class="top-nav">
        <a href="#" class="notif">
            <i class='bx bx-bell'></i>
            <span class="count">0</span>
        </a>
        <a href="#" class="profile">
            <img src="./assets/images/logo.png">
        </a>
    </nav> -->


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                <?php
                echo ($product["name"]);
                ?>
                <a href="edit-product.php?id=<?php echo $productId; ?>">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                </a>
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="products.php">
                        Product
                    </a>
                </li>
                /
                <li>
                    <a href="#" class="active">
                        <?php
                        echo ($product["name"]);
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="bottom-data">
        <div class="card-container">
            <div class="card">
                <div class="header">
                    <span class="material-symbols-outlined">
                        description
                    </span>
                    <h3>Description</h3>
                </div>
                <div class="text">
                    <p>
                        <?php
                        echo ($product["description"]);
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-container">
            <div class="card">
                <div class="header">
                    <span class="material-symbols-outlined">
                        payments
                    </span>
                    <h3>Price</h3>
                </div>
                <div class="text">
                    <p>
                        <?php
                        echo ($product["price"]);
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-container">
            <div class="card">
                <div class="header">
                    <span class="material-symbols-outlined">
                        category
                    </span>
                    <h3>Category</h3>
                </div>
                <div class="text">
                    <p>
                        <?php
                        echo ($categoryName["name"]);
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-container">
            <div class="card">
                <div class="header">
                    <span class="material-symbols-outlined">
                        image
                    </span>
                    <h3>Image</h3>
                </div>
                <div class="img-container">
                    <img src="<?php echo ($image["location"]); ?>" alt="<?php echo ($image["name"]); ?>">
                </div>
            </div>
        </div>

        <div class="card-container">

            <a class="deleteBtn" href="../handlers/processProducts.php?delete=<?php echo ($productId); ?>">
                <div class="header delete">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                    <h3>Delete</h3>
                </div>
            </a>
        </div>
    </div>

</main>

<script src="../assets/js/confirmDelete.js"></script>

</body>

</html>