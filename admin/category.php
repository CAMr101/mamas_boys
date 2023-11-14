<?php
include("../handlers/processCategory.php");
include("../handlers/processProducts.php");
include("../handlers/processImage.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$categoryId = $pathParams[1];

$category = getCategory($categoryId);
$image = getImageByCategoryId($category["id"]);

if ($image == null) {
    $image["name"] = "Image not found";
    $image["location"] = "";
}

?>


<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                <?php
                echo ($category["name"]);
                ?>
                <a href="edit-category.php?id=<?php echo $categoryId; ?>">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                </a>
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="shop.php">
                        Category
                    </a>
                </li>
                /
                <li>
                    <a href="#" class="active">
                        <?php
                        echo ($category["name"]);
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="insights">
        <a>
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        description
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Description
                    </h3>
                    <p>
                        <?php
                        echo ($category["description"]);
                        ?>
                    </p>
                </span>
            </li>
        </a>

        <a>
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        image
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Image
                    </h3>
                    <p>
                        <img src="<?php echo ($image["location"]); ?>" alt="<?php echo ($image["name"]); ?>">
                    </p>
                </span>
            </li>
        </a>

        <a href="../handlers/processCategory.php?fn=delete&id=<?php echo ($categoryId); ?>" class="delete">
            <li>
                <i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </i>
                <span class="info">
                    <h3>
                        Delete
                    </h3>
                    <p>
                        This will also delete all products within the
                        <?php echo ($category["name"]); ?> category
                    </p>
                </span>
            </li>
        </a>
    </ul>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>
                    Products
                    <a href="new-product.php">
                        <span class="material-symbols-outlined">
                            add
                        </span>
                    </a>
                </h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                            <td>001</td>
                            <td>Mustang</td>
                            <td>Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese</td>
                            <td>R 120</td>
                            <td>Kota</td>
                        </tr> -->

                    <?php
                    $products = getProductsByCategoryId($category["id"]);

                    if ($products !== null) {
                        foreach ($products as $product) { ?>

                            <tr>
                                <td>
                                    <?php echo $product['id']; ?>
                                </td>
                                <td>
                                    <?php echo $product['name']; ?>
                                </td>
                                <td>
                                    <?php echo $product['description']; ?>
                                </td>
                                <td>R
                                    <?php echo $product['price']; ?>
                                </td>
                            </tr>

                        <?php }
                    } else {

                    }
                    ?>

                    <!-- <tr>
                            <td>005</td>
                            <td>Porche</td>
                            <td>Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese</td>
                            <td>R 100</td>
                            <td>Kota</td>
                        </tr> -->
                </tbody>
            </table>
        </div>

    </div>

</main>



</body>

</html>