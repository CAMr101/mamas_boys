<?php
include "../handlers/processCategory.php";
include "../handlers/processProducts.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
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
                Categories
                <a href="new-category.php">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                </a>
            </h1>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>List of categories</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody class="">

                    <?php
                    $categories = getAllCategories();

                    if ($categories !== null) {
                        foreach ($categories as $category) { ?>
                            <tr>
                                <td>
                                    <a href="category.php?id=<?php echo $category['id']; ?>">
                                        <?php echo $category['id']; ?>
                                    </a>
                                </td>
                                <td>

                                    <?php echo $category['name']; ?>

                                </td>
                                <td>

                                    <?php echo $category['description']; ?>

                                </td>

                                <td id="buttons">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="edit-category.php?id=<?php echo $category['id']; ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </a>
                                        <form action="../handlers/deleteCategory.php" method="post"
                                            enctype="multipart/form-data">
                                            <input name="id" value="<?php echo $category['id']; ?>" type="hidden">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>

                        <?php }
                    } else {

                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>

</main>



</body>

</html>