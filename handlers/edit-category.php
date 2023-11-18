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
            <h1>Edit
                <?php echo ($category["name"]); ?>
            </h1>
            <ul class="breadcrumb">
                <li>
                    <a href="category.php?id=<?php echo $category['id']; ?>">
                        Category
                    </a>
                </li>
                /
                <li>
                    <a href="new-category.html" class="active">Edit</a>
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
                        echo ($category["description"]);
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
            <a href="../handlers/processCategory.php?delete=<?php echo ($categoryId); ?>" onclick="confirmDelete(1)">
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

            <form action="../handlers/processUpdateCategory.php" method="post" enctype="multipart/form-data"
                id="new-category">
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value=""> -->
                <table>

                    <tbody>
                        <tr>
                            <td>
                                <label for="name">Name</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="name" value="<?php  echo ($category["name"]); ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="description">Description</label>
                            </td>
                            <td>
                                <textarea name="description" class="form-control" id="description" cols="60" rows="5"
                                    form="new-category"><?php
                        echo ($category["description"]);
                        ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="image">Image</label>
                            </td>
                            <td>
                                <input type="file" class="form-control" type="file" id="formFile" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
                <button  class="btn btn-primary" >Save Changes</button>
            </form>


        </div>

    </div>

</main>


<script src="../assets/js/"></script>

</body>

</html>