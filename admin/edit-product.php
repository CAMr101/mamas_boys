<?php
include("../handlers/processCategory.php");
include("../handlers/processProducts.php");
include("../handlers/processImage.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$productId = $pathParams[1];

$product = getProduct($productId);
$image = getImageByCategoryId($product["id"]);

if ($image == null) {
    $image["name"] = "Image not found";
    $image["location"] = "";
}

$categories = getAllCategories();

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>Edit
                <?php echo ($product["name"]); ?>
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="products.php">
                        Product
                    </a>
                </li>
                /
                <li><a href="new-category.html" class="active">Edit</a></li>
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
            <a href="../handlers/processCategory.php?delete=<?php echo ($productId); ?>" onclick="confirmDelete(1)">
                <div class="header delete">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                    <h3>Delete</h3>
                </div>
            </a>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">

            <form action="../handlers/processProducts.php?update=<?php echo ($productId); ?>" method="post"
                enctype="multipart/form-data" id="update-product">
                <datalist id="categories">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo ($category["name"]) ?>"></option>
                    <?php } ?>
                </datalist>
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value=""> -->
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label for="name">Name</label>
                            </td>
                            <td>
                                <input type="text" name="name">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="price">Price</label>
                            </td>
                            <td>
                                <input type="number" name="price">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="ingredients">Ingredients</label>
                            </td>
                            <td>
                                <textarea name="ingredients" id="description" cols="60" rows="5"
                                    form="update-product"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="category">Category</label>
                            </td>
                            <td>
                                <input list="categories" name="category">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="image">Image</label>
                            </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" name="id" value="<?php
                echo ($productId);
                ?>">
                <button>Update Product</button>
            </form>


        </div>

    </div>

</main>


<script src="../assets/js/"></script>

</body>

</html>